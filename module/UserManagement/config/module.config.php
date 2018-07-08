<?php

return [
    'router' => include 'routes.config.php',
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'controllers' => [
        'factories' => [
            'UserManagement\Controller\Group' => \UserManagement\Controller\Factory\GroupControllerFactory::class,
            'UserManagement\Controller\User' => \UserManagement\Controller\Factory\UserControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'UserManagement\Listener\AccessListener' => \UserManagement\Listener\AccessListener::class,
            'UserManagement\Listener\ErrorListener' => \UserManagement\Listener\ErrorListener::class,
        ],
        'factories' => [
            'UserManagement\Service\User' => \UserManagement\Service\Factory\UserFactory::class,
            'UserManagement\Service\Group' => \UserManagement\Service\Factory\GroupFactory::class,
        ],
        'abstract_factories' => [
            \Zend\Db\Adapter\AdapterAbstractServiceFactory::class,
        ],
        'aliases' => [
            'Zend\Db\Adapter\Adapter' => 'Db\Mysql',
        ],
    ],
    'listeners' => [
        'UserManagement\Listener\AccessListener',
        'UserManagement\Listener\ErrorListener',
    ]
];
