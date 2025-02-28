# Log Plugins

## Adobe Commerce 2.4.7-p1

### For before, around and after plugin

```ssh
vendor/magento/framework/Interception/Interceptor.php

\Magento\Framework\Interception\Interceptor::___callPlugins
```

### Log ALL plugins 

```ssh
vendor/magento/framework/Interception/PluginList/PluginList.php

\Magento\Framework\Interception\PluginList\PluginList::getPlugin
```

```php
    public function getPlugin($type, $code)
    {
        if (!isset($this->_pluginInstances[$type][$code])) {
            $this->_pluginInstances[$type][$code] = $this->_objectManager->get(
                $this->_inherited[$type][$code]['instance']
            );
        }
        
        /** -------------------------- LOG -------------------------- */
        $this->getLog()->info($this->_inherited[$type][$code]['instance']);
        
        
        return $this->_pluginInstances[$type][$code];
    }


    /**
     * @param $file
     * @return \Zend_Log
     * @throws \Zend_Log_Exception
     */
    private function getLog($file = '/var/log/plugins.log')
    {
        $writer = new \Zend_Log_Writer_Stream(BP . $file);
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        return $logger;
    }
```


