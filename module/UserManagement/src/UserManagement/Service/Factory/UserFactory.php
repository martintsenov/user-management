<?php

namespace UserManagement\Service\Factory;

use UserManagement\Service\User as UserService;
use UserManagement\TableGateway\Group as GroupGateway;
use UserManagement\TableGateway\User as UserGateway;
use UserManagement\TableGateway\UserGroup as UserGroupGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Db\Mysql');
        $userGateway = new UserGateway($adapter);
        $userGroupGateway = new UserGroupGateway($adapter);
        $groupGateway = new GroupGateway($adapter);

        return new UserService($userGateway, $userGroupGateway, $groupGateway);
    }
}
