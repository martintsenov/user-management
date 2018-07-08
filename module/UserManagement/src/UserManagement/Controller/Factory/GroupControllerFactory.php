<?php

namespace UserManagement\Controller\Factory;

use UserManagement\Controller\GroupController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GroupControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();
        $groupService = $serviceLocator->get('UserManagement\Service\Group');

        return new GroupController($groupService);
    }
}
