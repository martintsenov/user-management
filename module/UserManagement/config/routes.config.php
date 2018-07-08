<?php

return [
    'routes' => [
        'UserManagement' => [
            'type' => 'Literal',
            'options' => [
                'route' => '/',
                'defaults' => [
                    '__NAMESPACE__' => 'UserManagement\Controller',
                ],
            ],
            'may_terminate' => false,
            'child_routes' => [
                'user' => [
                    'type' => 'Literal',
                    'options' => [
                        'route' => 'user',
                        'defaults' => [
                            'controller' => 'User',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes' => [
                        'user-add' => [
                            'type' => 'Literal',
                            'options' => [
                                'route' => '/add',
                                'defaults' => [
                                    'action' => 'add',
                                    'allowed-methods' => ['POST'],
                                ],
                            ],
                        ],
                        'user-list' => [
                            'type' => 'Literal',
                            'options' => [
                                'route' => '/list',
                                'defaults' => [
                                    'action' => 'list',
                                    'allowed-methods' => ['GET'],
                                ],
                            ],
                        ],
                        'user-details' => [
                            'type' => 'Segment',
                            'options' => [
                                'route' => '/details/:id',
                                'constraints' => [
                                    'id' => '[1-9]*',
                                ],
                                'defaults' => [
                                    'action' => 'details',
                                    'allowed-methods' => ['GET'],
                                ],
                            ],
                        ],
                        'user-delete' => [
                            'type' => 'Segment',
                            'options' => [
                                'route' => '/delete/:id',
                                'constraints' => [
                                    'id' => '[1-9]*',
                                ],
                                'defaults' => [
                                    'action' => 'delete',
                                    'allowed-methods' => ['POST'],
                                ],
                            ],
                        ],
                        'user-group-add' => [
                            'type' => 'Literal',
                            'options' => [
                                'route' => '/add-to-group',
                                'defaults' => [
                                    'action' => 'addToGroup',
                                    'allowed-methods' => ['POST'],
                                ],
                            ],
                        ],
                        'user-group-remove' => [
                            'type' => 'Segment',
                            'options' => [
                                'route' => '/remove-from-group/:userId/:groupId',
                                'constraints' => [
                                    'userId' => '[1-9]*',
                                    'groupId' => '[1-9]*',
                                ],
                                'defaults' => [
                                    'action' => 'removeFromGroup',
                                    'allowed-methods' => ['POST'],
                                ],
                            ],
                        ],
                    ],
                ],
                'group' => [
                    'type' => 'Literal',
                    'options' => [
                        'route' => 'group',
                        'defaults' => [
                            'controller' => 'Group',
                        ],
                    ],
                    'may_terminate' => true,
                    'child_routes' => [
                        'group-list' => [
                            'type' => 'Literal',
                            'options' => [
                                'route' => '/list',
                                'defaults' => [
                                    'action' => 'list',
                                    'allowed-methods' => ['GET'],
                                ],
                            ],
                        ],
                        'group-create' => [
                            'type' => 'Literal',
                            'options' => [
                                'route' => '/create',
                                'defaults' => [
                                    'action' => 'create',
                                    'allowed-methods' => ['POST'],
                                ],
                            ],
                        ],
                        'group-delete' => [
                            'type' => 'Segment',
                            'options' => [
                                'route' => '/delete/:id',
                                'constraints' => [
                                    'id' => '[1-9]*',
                                ],
                                'defaults' => [
                                    'action' => 'delete',
                                    'allowed-methods' => ['POST'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
