<?php

namespace UserManagement\Entity;

use UserManagement\Entity\ExchangeArrayTrait;

class User
{
    use ExchangeArrayTrait;

    private $id;
    private $name;
    private $email;
    /* @var array array of \UserManagement\Entity\Group */
    private $groups = [];
    private $created;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getGroups(): array
    {
        return $this->groups;
    }

    public function setGroups(array $groups)
    {
        $this->groups = $groups;
        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
}
