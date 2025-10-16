# Log XML Front responses

## Adobe Commerce 2.4.7-p1

````ssh
\Magento\Framework\View\Result\Page::render

````


````php

protected function render(HttpResponseInterface $response)
    {
        $this->pageConfig->publicBuild();
        if ($this->getPageLayout()) {
        
            /* ... */
            
            $output = $this->getLayout()->getOutput();
            $this->assign('layoutContent', $output);
            $output = $this->renderPage();
            
            /** -------------------------- LOG -------------------------- */
            $this->getLog()->info($this->getLayout()->getXmlString());
            
            $this->translateInline->processResponseBody($output);
            $response->appendBody($output);
        } else {
            parent::render($response);
        }
        return $this;
    }

    private function getLog($file = '/var/log/frame_view_result_page.log')
    {
        $writer = new \Zend_Log_Writer_Stream(BP . $file);
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        return $logger;
    }
````


