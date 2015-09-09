<?php

use Tester\Assert;
use WebinoConfigLib\Feature\InMemoryMailer;

require __DIR__ . '/../bootstrap.php';


$config = new InMemoryMailer;


Assert::equal([
    'mail' => [
        'transports' => [
            InMemoryMailer::class => ['type' => 'inmemory'],
        ],
    ],
], $config->toArray());
