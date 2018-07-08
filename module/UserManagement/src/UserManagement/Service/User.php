<?php

namespace UserManagement\Service;

use UserManagement\Entity\Group as GroupEntity;
use UserManagement\Entity\User as UserEntity;
use UserManagement\Exception\EntityNotFoundException;
use UserManagement\Exception\UserGroupException;
use UserManagement\Filter\UserGroupFilter;
use UserManagement\Filter\UserFilter;
use UserManagement\TableGateway\Group as GroupGateway;
use UserManagement\TableGateway\User as UserGateway;
use UserManagement\TableGateway\UserGroup as UserGroupGateway;

class User
{
    /* @var $userGateway \UserManagement\TableGateway\User */
    private $userGateway;
    /* @var $userGroupGateway \UserManagement\TableGateway\UserGroup */
    private $userGroupGateway;
    /* @var $groupGateway \UserManagement\TableGateway\Group */
    private $groupGateway;

    public function __construct(
        UserGateway $userGateway,
        UserGroupGateway $userGroupGateway,
        GroupGateway $groupGateway
    ) {
        $this->userGateway = $userGateway;
        $this->userGroupGateway = $userGroupGateway;
        $this->groupGateway = $groupGateway;
    }

    /**
     * Get all users
     *
     * @return array
     * @throws EntityNotFoundException
     */
    public function getAll(): array
    {
        $result = $this->userGateway->find();

        if (count($result) > 0) {
            return $this->parseListResult($result);
        }

        throw new EntityNotFoundException;
    }

    /**
     * Get user details
     *
     * @param int $userId
     * @return UserEntity
     * @throws EntityNotFoundException
     */
    public function details(int $userId): UserEntity
    {
        $user = $this->userGateway->findById($userId);

        if ($user instanceof UserEntity) {
            $userGroups = $this->userGroupGateway->findByUser($user);

            if (empty($userGroups)) {
                return $user;
            }

            $groupArr = [];

            foreach ($userGroups as $userGroup) {
                /* @var $group \UserManagement\Entity\Group */
                $group = $this->groupGateway->findById($userGroup['group_id']);
                $groupArr[] = $group->toArray();
            }

            $user->setGroups($groupArr);
            return $user;
        }

        throw new EntityNotFoundException;
    }

    /**
     * Add new user
     *
     * @param UserFilter $filter
     * @return UserEntity
     */
    public function add(UserFilter $filter): UserEntity
    {
        $user = new UserEntity;
        $user->setName($filter->getValue('name'));
        $user->setEmail($filter->getValue('email'));
        $userId = $this->userGateway->add($user);

        return $user->setId($userId);
    }

    /**
     * Remove user.
     *
     * @param int $userId
     * @return UserEntity
     * @throws EntityNotFoundException
     */
    public function remove(int $userId): bool
    {
        $user = $this->userGateway->findById($userId);

        if ($user instanceof UserEntity) {
            $this->userGateway->remove($user);
            return $this->userGroupGateway->removeByUser($user);
        }

        throw new EntityNotFoundException;
    }

    /**
     *
     * @param UserGroupFilter $filter
     * @return int
     * @throws UserGroupException
     */
    public function addToGroup(UserGroupFilter $filter)
    {
        $user = $this->userGateway->findById($filter->getValue('user_id'));
        $userGroup = $this->userGroupGateway->findByUser($user);

        if ($userGroup) {
            // user exist in this group
            throw new UserGroupException('User exist in group with id ' . $filter->getValue('group_id'));
        }

        $group = $this->groupGateway->findById($filter->getValue('group_id'));

        return $this->userGroupGateway->add($user, $group);
    }

    /**
     * Remove user from group
     *
     * @param UserGroupFilter $filter
     * @return int
     * @throws EntityNotFoundException
     */
    public function removeFromGroup(UserGroupFilter $filter)
    {
        $user = $this->userGateway->findById($filter->getValue('user_id'));

        if (!$user instanceof UserEntity) {
            throw new EntityNotFoundException;
        }

        $group = $this->groupGateway->findById($filter->getValue('group_id'));

        if (!$group instanceof GroupEntity) {
            throw new EntityNotFoundException;
        }

        return $this->userGroupGateway->removeByUserAndGroup($user, $group);
    }

    /**
     *
     * @param array $userArr
     * @return array
     */
    private function parseListResult(array $userArr): array
    {
        $parseArr = [];

        foreach ($userArr as $user) {
            /* @var $user \UserManagement\Entity\User */
            $parseArr[] = $user->toArray();
        }

        return $parseArr;
    }
}
