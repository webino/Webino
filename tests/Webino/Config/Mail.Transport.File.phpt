<?php

use Tester\Assert;
use WebinoBaseLib\Mail\Filename;
use WebinoConfigLib\Mail\Transport;

require __DIR__ . '/../bootstrap.php';


$transport[] = new Transport\File;

$transport[] = new Transport\File('my/folder/path');


Assert::equal([
    'type' => 'file',
    'options' => [
        'path' => 'tmp/mail',
        'callback' => Filename::class . '::create',
    ],
], $transport[0]->toArray());

Assert::equal([
    'type' => 'file',
    'options' => [
        'path' => 'my/folder/path',
        'callback' => Filename::class . '::create',
    ],
], $transport[1]->toArray());
