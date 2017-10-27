<?php
/**
 * Filesystem Config
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\MemoryFilesystem;
use WebinoAppLib\Filesystem\LocalFiles;
use WebinoAppLib\Filesystem\InMemoryFiles;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring the
     * memory filesystem.
     */
    new MemoryFilesystem,
]);

$app = Webino::application($config, Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar()))->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining local
     * filesystem service.
     */
    $localFiles1 = $event->getApp()->file();
    // or with adapter parameter
    $localFiles2 = $event->getApp()->file(LocalFiles::class);

    /**
     * Obtaining memory
     * filesystem service.
     */
    $memoryFiles = $event->getApp()->file(InMemoryFiles::class);

    // example memory file
    $memoryFiles->put('example.txt', null);

    $event->setResponse([
        new Html\Text('Hello Webino!'),
        new Html\FieldSet('Local Files 1:', $event->getApp()->debugR($localFiles1->listFiles())),
        new Html\FieldSet('Local Files 2:', $event->getApp()->debugR($localFiles2->listFiles())),
        new Html\FieldSet('Memory Files:', $event->getApp()->debugR($memoryFiles->listFiles())),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
