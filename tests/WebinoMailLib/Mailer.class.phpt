<?php

use Tester\Assert;
use WebinoMailLib\Mailer;
use Zend\Mail\Message;
use Zend\Mail\Transport\InMemory;

require __DIR__ . '/../bootstrap.php';


$mailer = new Mailer;


$mailer->send('recipient@example.com', 'The subject', 'The body');

/** @var InMemory $transport */
$transport = $mailer->getTransport();

/** @var \Zend\Mail\Message[] $messages */
$messages[] = $transport->getLastMessage();


Assert::type(Mailer::class, $mailer);
Assert::type(InMemory::class, $transport);
Assert::type(Message::class, $messages[0]);
Assert::true((bool) $messages[0]->getTo()->has('recipient@example.com'));
Assert::same('The subject', $messages[0]->getSubject());
Assert::same('The body', $messages[0]->getBody());
