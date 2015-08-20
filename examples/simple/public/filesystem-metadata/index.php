<?php
/**
 * Filesystem Metadata
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\TextHtml;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

// setup
$app->file()->write('my/folder/test.txt', 'Test file contents.');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining file
     * MIME type.
     */
    $mimetype = $event->getApp()->file()->getMimetype('my/folder/test.txt');

    /**
     * Obtaining file
     * timestamp.
     */
    $timestamp = $event->getApp()->file()->getTimestamp('my/folder/test.txt');

    /**
     * Obtaining file
     * size.
     */
    $size = $event->getApp()->file()->getSize('my/folder/test.txt');

    $event->setResponseContent([
        new TextHtml('MIME type: ' . $mimetype),
        new TextHtml('Timestamp: ' . $timestamp),
        new TextHtml('Size: ' . $size),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();

// cleanup
$app->file()->deleteDir('my');
