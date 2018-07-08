<?php

namespace UserManagement\TableGateway;

use UserManagement\Entity\User as UserEntity;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

class User extends TableGateway
{
    const TABLE = 'user';

    public function __construct(AdapterInterface $adapter)
    {
        // build the result as an entity
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new UserEntity);
        parent::__construct(static::TABLE, $adapter, null, $resultSet);
    }

    /**
     * Find all
     *
     * @param null|int $active
     * @return boolean|array
     */
    public function find()
    {
        $select = $this->sql->select();
        $result = $this->selectWith($select);

        if ($result->count() > 0) {
            return $result->toArray();
        }

        return false;
    }

    /**
     * Get user
     *
     * @param int $userId
     * @return boolean|UserEntity
     */
    public function findById(int $userId)
    {
        $select = $this->sql->select();
        $select->where(['id' => $userId]);
        $result = $this->selectWith($select);

        if ($result->count() > 0) {
            return $result->current();
        }

        return false;
    }

    /**
     * Add new user
     *
     * @param UserEntity $user
     * @return int
     */
    public function add(UserEntity $user)
    {
        $this->insert([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'created' => new Expression('NOW()'),
        ]);

        return $this->getLastInsertValue();
    }

    /**
     * Remove user
     *
     * @param UserEntity $user
     * @return int affected rows
     */
    public function remove(UserEntity $user)
    {
        $result = $this->delete([
            'id' => $user->getId()
        ]);

        return $result;
    }
}
