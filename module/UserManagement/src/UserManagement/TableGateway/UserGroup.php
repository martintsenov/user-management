<?php

namespace UserManagement\TableGateway;

use UserManagement\Entity\Group as GroupEntity;
use UserManagement\Entity\User as UserEntity;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;

class UserGroup extends TableGateway
{
    const TABLE = 'user_group';

    public function __construct(AdapterInterface $adapter)
    {
        parent::__construct(static::TABLE, $adapter);
    }

    /**
     * 
     * @param UserEntity $user
     * @return boolean|array
     */
    public function findByUser(UserEntity $user)
    {
        $select = $this->sql->select();
        $select->where(['user_id' => $user->getId()]);
        $result = $this->selectWith($select);

        if ($result->count() > 0) {
            return $result->toArray();
        }

        return false;
    }

    /**
     *
     * @param UserEntity $user
     * @param GroupEntity $group
     * @return boolean|array
     */
    public function findByUserAndGroup(UserEntity $user, GroupEntity $group)
    {
        $select = $this->sql->select();
        $select->where([
            'user_id' => $user->getId(),
            'group_id' => $group->getId(),
        ]);
        $result = $this->selectWith($select);

        if ($result->count() > 0) {
            return $result->toArray();
        }

        return false;
    }

    /**
     * Add relation between user and group
     *
     * @param UserEntity $user
     * @param GroupEntity $group
     * @return int
     */
    public function add(UserEntity $user, GroupEntity $group)
    {
        $this->insert([
            'user_id' => $user->getId(),
            'group_id' => $group->getId(),
        ]);
        
        return $this->getLastInsertValue();
    }

    /**
     * Remove user
     *
     * @param UserEntity $user
     * @return int affected rows
     */
    public function removeByUser(UserEntity $user)
    {
        $result = $this->delete([
            'user_id' => $user->getId()
        ]);

        return $result;
    }

    /**
     * Remove user from group
     * 
     * @param UserEntity $user
     * @param GroupEntity $group
     * @return int
     */
    public function removeByUserAndGroup(UserEntity $user, GroupEntity $group)
    {
        $result = $this->delete([
            'user_id' => $user->getId(),
            'group_id' => $group->getId(),
        ]);

        return $result;
    }
}
