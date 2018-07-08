<?php

namespace UserManagement\Controller;

use UserManagement\Controller\BaseController;
use UserManagement\Exception\InvalidArgumentException;
use UserManagement\Exception\RuntimeException;
use UserManagement\Filter\GroupFilter;
use UserManagement\Service\Group as GroupService;
use Zend\View\Model\JsonModel;

class GroupController extends BaseController
{
    /* @var $groupService \UserManagement\Service\Group */
    private $groupService;

    public function __construct(GroupService $groupService)
    {
        $this->groupService = $groupService;
    }

    public function listAction()
    {
        try {
            $data = $this->groupService->getAll();

            return new JsonModel(['code' => 200, 'data' => $data]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }
    
    public function createAction()
    {
        $filter = new GroupFilter();
        $filter->setData($this->params()->fromPost());
        
        if (!$filter->isValid()) {
            throw new InvalidArgumentException($this->parseFilterError($filter));
        }

        try {
            /* @var $group \UserManagement\Entity\Group */
            $group = $this->groupService->add($filter);

            return new JsonModel(['code' => 200, 'id' => $group->getId()]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }

    public function deleteAction()
    {
        try {
            $this->groupService->remove($this->params()->fromRoute('id'));

            return new JsonModel(['code' => 200]);
        } catch (\Exception $ex) {
            throw new RuntimeException($ex->getMessage());
        }
    }
}
