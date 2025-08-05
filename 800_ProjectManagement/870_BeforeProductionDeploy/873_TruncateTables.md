# Truncate tables


```sql

DO A BACKUP!!!!

SET FOREIGN_KEY_CHECKS = 0;
    -- ++++++++++++++++++++++++++++++++++++++ Customers ++++++++++++++++++++++++++++++++++++++
TRUNCATE TABLE customer_address_entity;
TRUNCATE TABLE customer_address_entity_datetime;
TRUNCATE TABLE customer_address_entity_decimal;
TRUNCATE TABLE customer_address_entity_int;
TRUNCATE TABLE customer_address_entity_text;
TRUNCATE TABLE customer_address_entity_varchar;
TRUNCATE TABLE customer_entity;
TRUNCATE TABLE customer_entity_datetime;
TRUNCATE TABLE customer_entity_decimal;
TRUNCATE TABLE customer_entity_int;
TRUNCATE TABLE customer_entity_text;
TRUNCATE TABLE customer_entity_varchar;

TRUNCATE TABLE log_customer;
TRUNCATE TABLE log_visitor;
TRUNCATE TABLE log_visitor_info;

-- ++++++++++++++++++++++++++++++++++++++ Company ++++++++++++++++++++++++++++++++++++++
TRUNCATE TABLE company;
TRUNCATE TABLE company_advanced_customer_entity;
TRUNCATE TABLE company_structure;
TRUNCATE TABLE company_roles;
TRUNCATE TABLE company_user_roles;

SET FOREIGN_KEY_CHECKS = 1;

-- ++++++++++++++++++++++++++++++++++++++ REDIS ++++++++++++++++++++++++++++++++++++++
DELETE CACHE FROM REDIS WITH bin/magento cache:clean
```