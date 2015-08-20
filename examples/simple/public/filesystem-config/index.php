<?php
/**
 * Filesystem Config
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\MemoryFilesystem;
use WebinoAppLib\Filesystem\LocalFiles;
use WebinoAppLib\Filesystem\InMemoryFiles;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring the
     * memory filesystem.
     */
    new MemoryFilesystem,
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining local
     * filesystem service.
     */
    $localFiles = $event->getApp()->file();
    // or
    $localFiles = $event->getApp()->file(LocalFiles::class);

    /**
     * Obtaining memory
     * filesystem service.
     */
    $memoryFiles = $event->getApp()->file(InMemoryFiles::class);

    $event->setResponseContent([
        'Hello Webino!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
