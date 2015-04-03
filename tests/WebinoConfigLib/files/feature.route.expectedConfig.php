<?php

return [
    'router' => [
        'routes' => [
            [
                'type'          => 'segment',
                'options'       => [
                    'defaults' => ['handlers' => ['ExampleHandler'], 'exampleKey' => 'exampleValue'],
                    'route'    => '/',
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    [
                        'type'    => 'literal',
                        'options' => [
                            'defaults' => ['handlers' => ['ExampleChildOneHandler']],
                            'route'    => '/child-one',
                        ],
                    ],
                    [
                        'type'    => 'literal',
                        'options' => [
                            'defaults' => ['handlers' => ['ExampleChildTwoHandler']],
                            'route'    => '/child-two',
                        ],
                    ],
                    [
                        'type'    => 'literal',
                        'options' => [
                            'defaults' => ['handlers' => ['ExampleChildThreeHandler']],
                            'route'    => '/child-three',
                        ],
                    ],
                ],
                'chain_routes'  => [
                    [
                        'type'    => 'literal',
                        'options' => [
                            'defaults' => ['handlers' => ['ExamplePartOneHandler']],
                            'route'    => '/part-one',
                        ],
                    ],
                    [
                        'type'    => 'literal',
                        'options' => [
                            'defaults' => ['handlers' => ['ExamplePartTwoHandler']],
                            'route'    => '/part-two',
                        ],
                    ],
                ],
            ],
        ],
    ],
];