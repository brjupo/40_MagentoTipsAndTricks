# Secure Magento Configurations

## Change admin page URL

DO NOT USE simple words like "admin"!! is the less secure URL for the admin!!
Mix letter, minus, mayus, dashes
For example: C0mp4n7-4dMIN-S3cUr3

## Turn off developer options

```sql
UPDATE `core_config_data` SET `value`='0' WHERE `path`='dev/debug/template_hints_storefront';
UPDATE `core_config_data` SET `value`='0' WHERE `path`='dev/debug/template_hints_storefront_show_with_parameter';
UPDATE `core_config_data` SET `value`='0' WHERE `path`='dev/debug/template_hints_admin';
UPDATE `core_config_data` SET `value`='0' WHERE `path`= 'dev/debug/template_hints_blocks';
UPDATE `core_config_data` SET `value`='0' WHERE `path`='customer/password/autocomplete_on_storefront';
UPDATE `core_config_data` SET `value`='0' WHERE `path`='admin/security/admin_account_sharing';
```

## Turn on security for Admin

```sql
UPDATE `core_config_data` SET `value`='1' WHERE `path`='admin/security/use_form_key';
UPDATE `core_config_data` SET `value`='1' WHERE `path`='admin/security/password_is_forced';
UPDATE `core_config_data` SET `value`='30' WHERE `path`='admin/security/password_lifetime';
```

## Set project in production MODE

```bash
php bin/magento deploy:mode:set production
```