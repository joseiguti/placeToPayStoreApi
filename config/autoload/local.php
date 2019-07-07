<?php
return [
    'db' => [
        'adapters' => [
            'Mysql' => [
                'database' => 'placetopay',
                'driver' => 'PDO_Mysql',
                'hostname' => 'localhost',
                'username' => 'root',
                'password' => 'root',
                'port' => '5432',
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ],
    ],
];
