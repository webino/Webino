<?php
/**
 * Filesystem Delete
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBox;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

// setup
$app->file()->write('my/folder/test.txt', 'Test file contents ' . rand());
$app->file()->write('my/folder/test-2.txt', null);

/**
 * Deleting
 * files.
 */
$app->file()->delete('my/folder/test-2.txt');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining test file contents
     * and removing a file at once.
     */
    $file = $event->getApp()->file()->readAndDelete('my/folder/test.txt');

    /**
     * Deleting
     * directories.
     */
    $event->getApp()->file()->deleteDir('my');

    $event->setResponse([
        'File contents:',
        new ScrollBox(nl2br(new Html\Text($file))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
