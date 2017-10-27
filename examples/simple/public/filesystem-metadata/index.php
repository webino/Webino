<?php
/**
 * Filesystem Metadata
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;

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

    $event->setResponse([
        new Html\Text('MIME type: ' . $mimetype),
        new Html\Text('Timestamp: ' . $timestamp),
        new Html\Text('Size: ' . $size),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();

// cleanup
$app->file()->deleteDir('my');
