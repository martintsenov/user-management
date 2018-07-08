<?php

namespace UserManagement\Service\Factory;

use UserManagement\Service\Group as GroupService;
use UserManagement\TableGateway\Group as GroupGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GroupFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Db\Mysql');
        $gateway = new GroupGateway($adapter);

        return new GroupService($gateway);
    }
}
