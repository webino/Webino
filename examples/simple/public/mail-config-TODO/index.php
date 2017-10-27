<?php
/**
 * Mail Config
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\FileMailer;
use WebinoConfigLib\Feature\SmtpMailer;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring the
     * file mailer.
     */
    new FileMailer(__DIR__),

    /**
     * Configuring
     * SMTP mailer.
     */
    new SmtpMailer('smtp.example.com', 'user@example.com', '123456'),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {

    // TODO message config
    $event->getApp()->mail()->getMessage()->setFrom('info@webino.sk');

    /**
     * Sending a mail.
     */
    $event->getApp()->mail()->send('test@webino.org', 'Test subject', 'Test message text.');

    // TODO mail parse

    $event->setResponse([
        'Hello Webino!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
