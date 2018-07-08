<?php

namespace UserManagement\TableGateway;

use UserManagement\Entity\Group as GroupEntity;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\TableGateway\TableGateway;

class Group extends TableGateway
{
    const TABLE = 'group';

    public function __construct(AdapterInterface $adapter)
    {
        // build the result as an entity
        $resultSet = new ResultSet(ResultSet::TYPE_ARRAYOBJECT, new GroupEntity);
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
     * Get group
     *
     * @param int $userId
     * @return boolean|GroupEntity
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
     * Add new group
     *
     * @param GroupEntity $group
     * @return int
     */
    public function add(GroupEntity $group)
    {
        $this->insert([
            'name' => $group->getName(),
            'description' => $group->getDescription(),
            'created' => new Expression('NOW()'),
        ]);

        return $this->getLastInsertValue();
    }

    /**
     * Remove group
     *
     * @param GroupEntity $group
     * @return int affected rows
     */
    public function remove(GroupEntity $group)
    {
        $result = $this->delete([
            'id' => $group->getId()
        ]);

        return $result;
    }
}
