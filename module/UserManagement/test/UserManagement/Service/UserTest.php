<?php

namespace UserManagementTest\Service;

use PHPUnit_Framework_TestCase;
use UserManagement\Service\User as UserService;

class UserTest extends PHPUnit_Framework_TestCase
{
    private $userService;

    public function setUp()
    {
        // mocks goes here
        $this->userService = new UserService(
            $userGatewayMock,
            $userGroupGatewayMock,
            $groupGatewayMock
        );
        parent::setUp();
    }

    public function test_Details_Success()
    {
        // test cases goes here
        $this->assertEquals($expected, $this->userService->details($userId));
    }

    public function test_Details_Throw_Exception()
    {
        // test cases goes here
        $this->assertEquals($expected, $this->userService->details($userId));
    }

    // rest of the test cases goes here
}
