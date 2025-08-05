<?php
return [
    'cache' => [
        'frontend' => [
            'default' => [
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => [
                    'server' => '0.0.0.05',
                    'port' => '6379',
                    'database' => '0',
                    'compress_data' => '1'
                ],
                'id_prefix' => '123_'
            ],
            'page_cache' => [
                'backend' => 'Cm_Cache_Backend_Redis',
                'backend_options' => [
                    'server' => '0.0.0.05',
                    'port' => '6379',
                    'database' => '1',
                    'compress_data' => '0'
                ],
                'id_prefix' => '123_'
            ]
        ],
        'graphql' => [
            'id_salt' => '123456'
        ]
    ],
    'MAGE_MODE' => 'production',
    'cache_types' => [
        'compiled_config' => 1,
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'target_rule' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1,
        'webhooks_response' => 1
    ],
    'backend' => [
        'frontName' => 'C0mp4n7-4dMIN-S3cUr3'
    ],
    'db' => [
        'connection' => [
            'default' => [
                'host' => '0.0.0.03',
                'username' => 'db_uname',
                'dbname' => 'db_name',
                'password' => 'MyPass'
            ],
            'indexer' => [
                'host' => '0.0.0.03',
                'username' => 'db_uname',
                'dbname' => 'db_name',
                'password' => 'MyPass'
            ]
        ],
        'slave_connection' => [
            'indexer' => [
                'host' => '0.0.0.04',
                'username' => 'dbs_uname',
                'dbname' => 'dbs_name',
                'password' => 'MyName',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'synchronous_replication' => true
            ]
        ],
        'use_slave_connection' => true
    ],
    'queue' => [
        'consumers_wait_for_messages' => 0
    ],
    'crypt' => [
        'key' => '1234567890'
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'session' => [
        'save' => 'redis',
        'redis' => [
            'host' => '0.0.0.05',
            'port' => '6379',
            'password' => '',
            'timeout' => '2.5',
            'database' => '2',
            'compression_threshold' => '2048',
            'compression_library' => 'gzip',
            'log_level' => '1',
            'max_concurrency' => '6',
            'break_after_frontend' => '5',
            'fail_after' => '10',
            'disable_locking' => '0',
            'min_lifetime' => '60',
            'max_lifetime' => '2592000'
        ]
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => null
        ]
    ],
    'downloadable_domains' => [
        'mag247.com'
    ],
    'install' => [
        'date' => 'Mon, 04 Aug 2025 05:54:37 +0000'
    ],
    'system' => [
        'default' => [
            'catalog' => [
                'search' => [
                    'engine' => 'opensearch',
                    'opensearch_server_hostname' => '0.0.0.05',
                    'opensearch_server_port' => 9200,
                    'opensearch_index_prefix' => 'op_pref_'
                ]
            ]
        ]
    ]
];