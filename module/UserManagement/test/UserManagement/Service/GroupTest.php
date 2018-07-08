<?php

namespace UserManagementTest\Service;

use PHPUnit_Framework_TestCase;
use UserManagement\Service\Group as GroupService;

class GroupTest extends PHPUnit_Framework_TestCase
{
     private $groupService;

    public function setUp()
    {
        // mocks goes here
        $this->groupService = new GroupService($groupGatewayMock);
        parent::setUp();
    }

    public function test_Remove_Success()
    {
        // test cases goes here
        $this->assertEquals($expected, $this->groupService->remove($groupId));
    }

    public function test_Remove_Throw_Exception()
    {
        // test cases goes here
        $this->assertEquals($expected, $this->groupService->remove($groupId));
    }

    // rest of the test cases goes here
}
