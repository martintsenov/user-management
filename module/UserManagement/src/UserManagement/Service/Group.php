<?php

namespace UserManagement\Service;

use UserManagement\Entity\Group as GroupEntity;
use UserManagement\Exception\EntityNotFoundException;
use UserManagement\Filter\GroupFilter;
use UserManagement\TableGateway\Group as GroupGateway;

class Group
{
    /* @var $groupGateway \UserManagement\TableGateway\Group */
    private $groupGateway;

    public function __construct(GroupGateway $groupGateway)
    {
        $this->groupGateway = $groupGateway;
    }

    /**
     * Get all groups
     *
     * @return array
     * @throws EntityNotFoundException
     */
    public function getAll(): array
    {
        $result = $this->groupGateway->find();

        if (count($result) > 0) {
            return $this->parseListResult($result);
        }

        throw new EntityNotFoundException;
    }

    /**
     * Add new group
     *
     * @param GroupFilter $filter
     * @return GroupEntity
     */
    public function add(GroupFilter $filter): GroupEntity
    {
        $group = new GroupEntity;
        $group->setName($filter->getValue('name'));
        $group->setDescription($filter->getValue('description'));
        $groupId = $this->groupGateway->add($group);

        return $group->setId($groupId);
    }

    /**
     * Remove group.
     *
     * @param int $groupId
     * @return GroupEntity
     * @throws EntityNotFoundException
     */
    public function remove(int $groupId): bool
    {
        $group = $this->groupGateway->findById($groupId);

        if ($group instanceof GroupEntity) {
            return $this->groupGateway->remove($group);

        }

        throw new EntityNotFoundException;
    }

    /**
     *
     * @param array $groupArr
     * @return array
     */
    private function parseListResult(array $groupArr): array
    {
        $parseArr = [];

        foreach ($groupArr as $group) {
            /* @var $group \UserManagement\Entity\Group */
            $parseArr[] = $group->toArray();
        }

        return $parseArr;
    }
}
