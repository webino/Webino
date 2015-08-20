<?php
/**
 * Filesystem Directories
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

/**
 * Creating
 * directories.
 */
$app->file()->createDir('my/folder');

// example file setup
$app->file()->write('my/folder/test.txt', null);

/**
 * Emptying
 * directories.
 */
$app->file()->emptyDir('my/folder');

/**
 * Deleting
 * directories.
 */
$app->file()->deleteDir('my/folder');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Hello Webino!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
