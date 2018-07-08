<?php

namespace UserManagement\Filter;

use Zend\InputFilter\InputFilter;

class UserGroupFilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'user_id',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'Regex',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'pattern' => '[0-9]+',
                        'messages' => [
                            \Zend\Validator\Regex::NOT_MATCH => 'user_id is mandatory',
                        ],
                    ],
                ]
            ],
        ]);
        $this->add([
            'name' => 'group_id',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'Regex',
                    'break_chain_on_failure' => true,
                    'options' => [
                        'pattern' => '[0-9]+',
                        'messages' => [
                            \Zend\Validator\Regex::NOT_MATCH => 'group_id is mandatory',
                        ],
                    ],
                ]
            ],
        ]);
    }
}
