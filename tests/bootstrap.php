<?php

use Zend\Loader\AutoloaderFactory;

include 'vendor/zendframework/zendframework/library/Zend/Loader/AutoloaderFactory.php';

AutoloaderFactory::factory([
    'Zend\Loader\StandardAutoloader' => [
        'autoregister_zf' => true,
        'namespaces' => [
            'UserManagement' => 'module/UserManagement/src/UserManagement',
            'UserManagementTest' => 'module/UserManagement/test/UserManagement',
        ],
    ],
]);
