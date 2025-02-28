# Log Observers

## Adobe Commerce 2.4.7-p1


### Log ALL observers

```ssh
vendor/magento/framework/Event/Manager.php

\Magento\Framework\Event\Manager::dispatch
```

```php
    public function dispatch($eventName, array $data = [])
    {
        $eventName = $eventName !== null ? mb_strtolower($eventName) : '';
        \Magento\Framework\Profiler::start('EVENT:' . $eventName, ['group' => 'EVENT', 'name' => $eventName]);
        foreach ($this->_eventConfig->getObservers($eventName) as $observerConfig) {
        
            /** -------------------------- LOG -------------------------- */
            $this->getLog()->info($observerConfig['instance']);
            
            
            
            $event = new \Magento\Framework\Event($data);
            $event->setName($eventName);

            $wrapper = new Observer();
            // phpcs:ignore Magento2.Performance.ForeachArrayMerge
            $wrapper->setData(array_merge(['event' => $event], $data));

            \Magento\Framework\Profiler::start('OBSERVER:' . $observerConfig['name']);
            $this->_invoker->dispatch($observerConfig, $wrapper);
            \Magento\Framework\Profiler::stop('OBSERVER:' . $observerConfig['name']);
        }
        \Magento\Framework\Profiler::stop('EVENT:' . $eventName);
    }

    /**
     * @param $file
     * @return \Zend_Log
     * @throws \Zend_Log_Exception
     */
    private function getLog($file = '/var/log/observers.log')
    {
        $writer = new \Zend_Log_Writer_Stream(BP . $file);
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        return $logger;
    }
```


