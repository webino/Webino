<?php

use Tester\Assert;
use WebinoBaseLib\Mail\Filename;
use WebinoConfigLib\Feature\SmtpMailer;

require __DIR__ . '/../bootstrap.php';


$config = new SmtpMailer('mail.example.com', 'mail@example.com', '123456');


Assert::equal([
    'mail' => [
        'transports' => [
            SmtpMailer::class => [
                'type' => 'smtp',
                'options' => [
                    'host' => 'mail.example.com',
                    'connection_class' => 'login',
                    'connection_config' => [
                        'username' => 'mail@example.com',
                        'password' => '123456',
                    ],
                ],
            ],
        ],
    ],
], $config->toArray());
