<?php

namespace UserManagement\Controller;

use UserManagement\Controller\BaseController;
use UserManagement\Exception\InvalidArgumentException;
use UserManagement\Exception\RuntimeException;
use UserManagement\Filter\UserFilter;
use UserManagement\Filter\UserGroupFilter;
use UserManagement\Service\User as UserService;
use Zend\View\Model\JsonModel;

class UserController extends BaseController
{
    /* @var $userService \UserManagement\Service\User */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function addAction()
    {
        $filter = new UserFilter();
        $filter->setData($this->params()->fromPost());

        if (!$filter->isValid()) {
            throw new InvalidArgumentException($this->parseFilterError($filter));
        }

        try {
            /* @var $user \UserManagement\Entity\User */
            $user = $this->userService->add($filter);

            return new JsonModel(['code' => 200, 'id' => $user->getId()]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }

    public function listAction()
    {
        try {
            $data = $this->userService->getAll();

            return new JsonModel(['code' => 200, 'data' => $data]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }
    
    public function detailsAction()
    {
        try {
            /* @var $user \UserManagement\Entity\User */
            $user = $this->userService->details($this->params()->fromRoute('id'));

            return new JsonModel(['code' => 200, 'data' => $user->toArray()]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }

    public function deleteAction()
    {
        try {
            $this->userService->remove($this->params()->fromRoute('id'));

            return new JsonModel(['code' => 200]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }
    
    public function addToGroupAction()
    {
        $filter = new UserGroupFilter();
        $filter->setData($this->params()->fromPost());

        if (!$filter->isValid()) {
            throw new InvalidArgumentException($this->parseFilterError($filter));
        }

        try {
            $this->userService->addToGroup($filter);
            
            return new JsonModel(['code' => 200]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }
    
    public function removeFromGroupAction()
    {
        $userId = $this->params()->fromRoute('userId', false);
        $groupId = $this->params()->fromRoute('groupId', false);
        $filter = new UserGroupFilter();
        $filter->setData([
            'user_id' => $userId,
            'group_id' => $groupId,
            
        ]);

        if (!$filter->isValid()) {
            throw new InvalidArgumentException($this->parseFilterError($filter));
        }
        
        try {
            $this->userService->removeFromGroup($filter);

            return new JsonModel(['code' => 200]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }
}
