<?php
/**
 * Filesystem Copy / Rename
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

/**
 * Copying
 * files.
 */
$app->file()->copy('my/folder/test.txt', 'my/folder-2/test-2.txt');

/**
 * Renaming
 * files.
 */
$app->file()->rename('my/folder-2/test-2.txt', 'my/folder-3/test-3.txt');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining test
     * file contents.
     */
    $file  = $event->getApp()->file()->read('my/folder/test.txt') . PHP_EOL;
    $file .= $event->getApp()->file()->read('my/folder-3/test-3.txt');

    $event->setResponse([
        'File contents:',
        new ScrollBox(nl2br(new Html\Text($file))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();

// cleanup
$app->file()->delete('my/folder/test.txt');
$app->file()->delete('my/folder-3/test-3.txt');
