<?php

namespace UserManagement\Exception;

use UserManagement\Exception\ExceptionInterface;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
    // custom logic goes here
}
