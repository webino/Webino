<?php

return [
    'example_settings' => ['example_key' => 'example_value'],
    'cache'            => [
        'adapter' => [
            'name'    => 'filesystem',
            'options' => [
                'namespace'      => 'application',
                'cacheDir'       => 'data/cache',
                'dirPermission'  => false,
                'filePermission' => false,
                'umask'          => 7,
            ],
        ],
        'plugins' => ['serializer'],
    ],
    'router'           => [
        'routes' => [
            [
                'type'    => 'literal',
                'options' => [
                    'defaults' => ['handlers' => ['ExampleHandler']],
                    'route'    => '/',
                ],
            ],
            'home' => [
                'type'         => 'literal',
                'options'      => [
                    'defaults' => [
                        'handlers'  => ['default' => 'ExampleHandler2'],
                        'testParam' => 'testParamValue',
                    ],
                    'route'    => '/home2',
                ],
                'child_routes' => [
                    'about' => ['type' => 'literal', 'options' => ['defaults' => []]],
                ],
            ],
        ],
    ],
];
