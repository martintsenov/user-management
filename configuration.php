<?php

return [
    'env' => [],
    'db' => [
        'adapters' => [
            'Db\Mysql' => [
                'driver' => 'PdoMysql',
                'hostname' => 'localhost',
                'database' => 'user_management',
                'username' => 'root',
                'password' => '',
                'driver_options' => [

                ],
            ],
            'Db\Postgre' => [
                'driver' => 'pgsql',
                'hostname' => '',
                'database' => '',
                'username' => '',
                'password' => '',
                'schema' => '',
                'port' => '',
            ],
        ],
    ],
];
