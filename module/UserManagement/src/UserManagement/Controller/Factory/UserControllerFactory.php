<?php

namespace UserManagement\Controller\Factory;

use UserManagement\Controller\UserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();
        $userService = $serviceLocator->get('UserManagement\Service\User');

        return new UserController($userService);
    }
}
