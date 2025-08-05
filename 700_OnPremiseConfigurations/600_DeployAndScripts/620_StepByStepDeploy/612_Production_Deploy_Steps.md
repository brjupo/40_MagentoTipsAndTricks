# Production Deploy Steps

## Check files modification for:

- ./app/etc/env.php
- ./app/etc/NonComposerComponentRegistration.php


## At server A, B and C [Do this steps on each server]

````bash 
php bin/magento maintenance:enable

git stash
git pull origin integration
composer install
#git apply m2-hotfixes/*.patch  
rm -rf ./generated/* 
````

## At server A

````bash
rm -rf ./pub/static/*/* ./var/session/* ./var/view_preprocessed/* ./var/cache/* ./var/page_cache/*
php bin/magento setup:upgrade
php bin/magento setup:di:compile

php bin/magento cache:flush
php bin/magento cache:clean
````

## At Server B [Wait that server A finishes previous step]

````bash
rm -rf ./pub/static/*/* ./var/session/* ./var/view_preprocessed/* ./var/cache/* ./var/page_cache/*
php bin/magento setup:upgrade       ## As individual env.php and config.php files per server 
php bin/magento setup:di:compile
php bin/magento cache:flush
````

## At Server C [Wait that server B finishes previous step]

````bash
rm -rf ./pub/static/*/* ./var/session/* ./var/view_preprocessed/* ./var/cache/* ./var/page_cache/*
php bin/magento setup:upgrade       ## As individual env.php and config.php files per server
php bin/magento setup:di:compile
php bin/magento cache:flush
````

## At server A

````bash

php bin/magento setup:static-content:deploy en_US es_MX -j8 # [with j16 it takes 20 minutes]

rsync -azv ~/app/var/view_preprocessed/ mag247@0.0.0.01:~/app/var/view_preprocessed/
rsync -azv ~/app/var/view_preprocessed/ mag247@0.0.0.02:~/app/var/view_preprocessed/

````

## At server A, B and C [Do this steps on each server]

````bash 
php bin/magento maintenance:disable 
````
