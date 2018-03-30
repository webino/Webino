<?php

use Tester\Assert;
use WebinoConfigLib\Mail\Transport;

require __DIR__ . '/../bootstrap.php';


$transport[] = new Transport\Smtp('mail.example.com', 'mail@example.com', '123456');

$transport[] = (new Transport\Smtp('mail.example.com', 'mail@example.com', '123456'))->setSsl();

$transport[] = (new Transport\Smtp('mail.example.com', 'mail@example.com', '123456'))->setSsl(123);

$transport[] = (new Transport\Smtp('mail.example.com', 'mail@example.com', '123456'))->setTls();

$transport[] = (new Transport\Smtp('mail.example.com', 'mail@example.com', '123456'))->setTls(123);


Assert::equal([
    'type' => 'smtp',
    'options' => [
        'host' => 'mail.example.com',
        'connection_class' => 'login',
        'connection_config' => [
            'username' => 'mail@example.com',
            'password' => '123456',
        ],
    ],
], $transport[0]->toArray());

Assert::equal([
    'type' => 'smtp',
    'options' => [
        'host' => 'mail.example.com',
        'port' => 465,
        'connection_class' => 'login',
        'connection_config' => [
            'ssl' => 'ssl',
            'username' => 'mail@example.com',
            'password' => '123456',
        ],
    ],
], $transport[1]->toArray());

Assert::equal([
    'type' => 'smtp',
    'options' => [
        'host' => 'mail.example.com',
        'port' => 123,
        'connection_class' => 'login',
        'connection_config' => [
            'ssl' => 'ssl',
            'username' => 'mail@example.com',
            'password' => '123456',
        ],
    ],
], $transport[2]->toArray());

Assert::equal([
    'type' => 'smtp',
    'options' => [
        'host' => 'mail.example.com',
        'port' => 587,
        'connection_class' => 'login',
        'connection_config' => [
            'ssl' => 'tls',
            'username' => 'mail@example.com',
            'password' => '123456',
        ],
    ],
], $transport[3]->toArray());

Assert::equal([
    'type' => 'smtp',
    'options' => [
        'host' => 'mail.example.com',
        'port' => 123,
        'connection_class' => 'login',
        'connection_config' => [
            'ssl' => 'tls',
            'username' => 'mail@example.com',
            'password' => '123456',
        ],
    ],
], $transport[4]->toArray());
