<?php
/**
 * Filesystem Listing
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\HorizontalLineHtml;

require __DIR__ . '/../../vendor/autoload.php';

$debugger = Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar());

$app = Webino::application(null, $debugger)->bootstrap();

// setup
$app->file()->write('my/folder/test.txt', null);
$app->file()->write('my/folder/test-2.txt', null);
$app->file()->write('my/folder/folder-2/test-3.txt', null);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Listing directory
     * contents recursively.
     */
    $list = $event->getApp()->file()->listContents('my/folder', true);

    /**
     * Listing directory
     * paths recursively.
     */
    $paths = $event->getApp()->file()->listPaths('my/folder', true);

    /**
     * Listing directory
     * files recursively.
     */
    $files = $event->getApp()->file()->listFiles('my/folder', true);

    $event->setResponseContent([
        'Directory contents:',
        $event->getApp()->debug($list, true),
        new HorizontalLineHtml,
        'Directory paths:',
        $event->getApp()->debug($paths, true),
        new HorizontalLineHtml,
        'Directory files:',
        $event->getApp()->debug($files, true),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();

// cleanup
$app->file()->deleteDir('my');
