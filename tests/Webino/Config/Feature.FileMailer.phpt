<?php

use Tester\Assert;
use WebinoBaseLib\Mail\Filename;
use WebinoConfigLib\Feature\FileMailer;

require __DIR__ . '/../bootstrap.php';


$config = new FileMailer;


Assert::equal([
    'mail' => [
        'transports' => [
            FileMailer::class => [
                'type' => 'file',
                'options' => [
                    'path' => 'tmp/mail',
                    'callback' => Filename::class . '::create',
                ],
            ],
        ],
    ],
], $config->toArray());
