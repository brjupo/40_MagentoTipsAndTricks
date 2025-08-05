# Hints that help at a production deploy

# The system DO NOT detect app/code modules

We need to add logs to these files

## PHP Logs

nano app/etc/NonComposerComponentRegistration.php        [Log NO-composer modules]

## Logs with PSR/Logger

nano
vendor/magento/framework/Component/ComponentRegistrar.php [Check every single element that will be rendered at frontend]
nano vendor/magento/framework/View/Result/Page.php      [Print, in a log, all the XML blocks]

---

# Check minification and merge configuration

## Useful Querys

```sql
SELECT *
FROM core_config_data
WHERE `path` = 'dev/js/merge_files'
   OR `path` = 'dev/js/enable_js_bundling'
   OR `path` = 'dev/js/minify_files'
   OR `path` = 'dev/css/merge_css_files'
   OR `path` = 'dev/css/minify_files'
   OR path LIKE 'amoptimizer%';

-- UPDATE `core_config_data` SET `value`='0' WHERE `path`='dev/js/merge_files';
-- UPDATE `core_config_data` SET `value`='0' WHERE `path`='dev/js/enable_js_bundling';
-- UPDATE `core_config_data` SET `value`='1' WHERE `path`='dev/js/minify_files';
-- UPDATE `core_config_data` SET `value`='0' WHERE `path`='dev/css/merge_css_files';
-- UPDATE `core_config_data` SET `value`='1' WHERE `path`='dev/css/minify_files';
```

---

# The system DO NOT detect the app/design themes

## Every theme should inherir from the right parent Revisar que cada tema herede del padre correcto

https://magento.stackexchange.com/questions/100164/how-to-delete-a-theme/128334#128334

NORMALLY the parent ALWAYS BECOME "LUMA"

```sql
SELECT *
FROM core_config_data
WHERE path = "design/theme/theme_id";

UPDATE core_config_data
SET value = 2
WHERE config_id = 912
   OR config_id = 957
   OR config_id = 958;

UPDATE core_config_data
SET value = 14
WHERE config_id = 912;

UPDATE core_config_data
SET value = 15
WHERE config_id = 957;

UPDATE core_config_data
SET value = 16
WHERE config_id = 958;


SELECT theme_id, parent_id, theme_path
FROM theme;
DELETE
FROM theme
WHERE theme_id = 11;
```

The current result after an upgrade:

| theme_id | parent_id | theme_path       |
|----------|-----------|------------------|
| 1        | NULL      | Magento/blank    |
| 2        | 1         | Magento/luma     |
| 3        | NULL      | Magento/backend  |
| 8        | 3         | Magento/spectrum |
| 11       | 2         | MyTheme/myparent |
| 12       | 2         | MyTheme/myson1   |
| 13       | 2         | MyTheme/myson2   |

The MUST BE result

| theme_id | parent_id | theme_path       |
|----------|-----------|------------------|
| 1        | NULL      | Magento/blank    |
| 2        | 1         | Magento/luma     |
| 3        | NULL      | Magento/backend  |
| 8        | 3         | Magento/spectrum |
| 11       | 2         | MyTheme/myparent |
| 12       | 11        | MyTheme/myson1   |
| 13       | 11        | MyTheme/myson2   |

The querys to update [be careful!]

````sql
UPDATE theme
SET parent_id = 11
WHERE theme_id = 12
   OR theme_id = 13;
````

---

# Styles, CSS files or JS files seem obsolesced

# deployed_version.txt

Files may not display correctly in the client's browser. This may be due to an outdated "deployed_version.txt" file on one of the servers. You should check the file:

- cat ~/app/pub/static/deployed_version.txt

On each server. You will need to verify that the directory

- ~/app/var/view_preprocessed/

Is correctly synchronized on all three servers.

---

# Symbolic links examples

## Rename a Symbolic link

mv myLink myNewLink 

## Create a Symbolic link

Remove the directory BEFORE create the symbolic link, otherwise a file will be created inside that folder

ln -s /mnt/shared/var/ ~/app/var
ln -s /mnt/shared/var/export/ ~/app/var/export
ln -s /mnt/shared/var/import/ ~/app/var/import
ln -s /mnt/shared/media/ ~/app/pub/media
ln -s /mnt/shared/static ~/app/pub/static
ln -s /mnt/shared/etc ~/app/app/etc

## Delete a Symbolic link

rm link_ln

---

# RSYNC exmaples to sincronize servers

rsync -azv ~/app/generated/ mag247@0.0.0.0:~/app/generated/

rsync -azv ~/app/var/ mag247@0.0.0.0:~/app/var/
rsync -azv /mnt/shared/var/ ~/app/var/

rsync -avz nginx.conf.sample mag247@0.0.0.0:~/app/nginx.conf.sample
rsync -avz nginx.conf.sample mag247@0.0.0.02:~/app/nginx.conf.sample

---

