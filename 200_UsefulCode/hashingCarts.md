# Hashing Carts



````php

    /**
     * The merchant ask us to decrease the request to his SAP system
     * To achieve it we can hash the request and avoid unnecessary request
     * We need to consider the following variables to successfully HASH UNIQUE responses
     * Change of products
     * Change of quantities
     * Change of shipping method 
     * Change of Transporters shipping option
     * Change of Transporters reception point
     *
     * Also, we need to consider a timeout for these hashes.
     * TIMEOUT =  1 Second
     *
     * @param $quote
     * @return false | array
     */
    public function getProductPricesOrHash(int $step, Quote $quote): false|array
    {
        $result = [];
        $md5hash = null;

        try {
            // Create Hash
            $hash = "";
            foreach ($quote->getAllItems() as $item) {
                $hash .= $item->getSku() . $item->getQty();
            }
            $hash .= $quote->getCedis();
            if ($quote->getShippingAddress() && $quote->getShippingAddress()->getCustomerAddressId()) {
                $hash .= $quote->getShippingAddress()->getCustomerAddressId();
            }
            // TODO Add more changable fields [Check the power point]

            $md5hash = md5($hash);

            // Search and Validate Hash
            if ($this->_checkoutSession->{"getId" . $md5hash}() && $this->isHashValid($md5hash)) {
                // If hash exist and is NOT expired Return hash
                $this->logger->info(' HASHED returned');
                $result = $this->_checkoutSession->{"getId" . $md5hash}();
            } else {
                // CALL TO FUNCTION TO DO THE REQUEST!
                $result = $this->getProductPrices($step, $quote);
                if (empty($result) || $result['CONSULTA_PRECIO']['MENSAJE_RET']['TIPO'] == "E") {
                    // Variable used for CART
                    $this->_checkoutSession->setSapPrices(false);
                } else {
                    // Save Hash
                    $this->_checkoutSession->setSapPrices(true);
                    $this->_checkoutSession->{"setId" . $md5hash}($result);
                }
            }
        } catch (\Exception $e) {
            $this->logger->error(__METHOD__ . $e->getMessage());
        }
        // Save hashes expiration time
        $this->saveHashesExpirationTime($md5hash);
        return $result;
    }

    /**
     * Merchant TIMEOUT = 30s
     *
     * Considering that
     * The MAX session time is 15 minutes as merchant request
     * Checkout Session is deleted when customer Session is closed CONFIRMED!
     * TODO Clean checkout session _checkoutSession->unsOldHashArray() when arrived at Success Page
     *
     * @return string
     * @throws \DateMalformedStringException
     */
    private function getHashUniqueByTime(): string
    {
        $hashedTime = (new \DateTime())->modify('+30 seconds')->format('i:s');

        $this->logger->info('Time HASHED expires: ' . $hashedTime);
        // Now we can return a unique hash
        return $hashedTime;
    }

    private function isHashValid($md5hash)
    {
        if (!$md5hash) {
            return false;
        }
        $oldHashArray = $this->_checkoutSession->getOldHashArray();
        if (
            is_array($oldHashArray) &&
            count($oldHashArray) !== 0 &&
            isset($oldHashArray[$md5hash])
        ) {
            $expirationDate = $oldHashArray[$md5hash]['expiration_time'];
            $nowTime = (new \DateTime())->format('i:s');
            $this->logger->info(__METHOD__);
            $this->logger->info('Comparing now: ' . $nowTime . ' vs expiration: ' . $expirationDate);
            if ($nowTime < $expirationDate) {
                $this->logger->info('Returns TRUE!');
                return true;
            }
        }
        return false;

    }

    private function saveHashesExpirationTime($md5hash)
    {
        // TODO Clean old hashes
        $oldHashArray = is_array($this->_checkoutSession->getOldHashArray()) ? $this->_checkoutSession->getOldHashArray() : [];

        $expirationTime = $this->getHashUniqueByTime();
        $oldHashArray[$md5hash] = ['expiration_time' => $expirationTime];
        $this->_checkoutSession->setOldHashArray($oldHashArray);
    }
````