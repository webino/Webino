<?php

use WebinoConfigLib\Feature\InMemoryMailer;
use WebinoMailLib\MailerInterface;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$config = Webino::config([
    new InMemoryMailer,
]);

$app = Webino::application($config)->bootstrap();


$app->mail()->send('test@webino.org', 'Test subject', 'Test message text.');

/** @var \Zend\Mail\Transport\InMemory $transport */
$transport = $app->mail()->getTransport();

/** @var \Zend\Mail\Message[] $messages */
$messages[] = $transport->getLastMessage();


Assert::type(MailerInterface::class, $app->getMailer());
Assert::true((bool) $messages[0]->getTo()->has('test@webino.org'));
Assert::same('Test subject', $messages[0]->getSubject());
Assert::same('Test message text.', $messages[0]->getBody());
