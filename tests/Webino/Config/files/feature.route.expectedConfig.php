<?php

return [
    'router' => [
        'routes' => [
            [
                'type'          => 'segment',
                'options'       => [
                    'defaults' => ['exampleKey' => 'exampleValue'],
                    'route'    => '/',
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'child-one' => [
                        'type'    => 'literal',
                        'options' => [
                            'route' => '/child-one',
                        ],
                    ],
                    [
                        'type'    => 'literal',
                        'options' => [
                            'route' => '/child-two',
                        ],
                    ],
                    [
                        'type'    => 'literal',
                        'options' => [
                            'route' => '/child-three',
                        ],
                    ],
                ],
                'chain_routes'  => [
                    [
                        'type'    => 'literal',
                        'options' => [
                            'route' => '/part-one',
                        ],
                    ],
                    [
                        'type'    => 'literal',
                        'options' => [
                            'route' => '/part-two',
                        ],
                    ],
                ],
            ],
        ],
    ],
];