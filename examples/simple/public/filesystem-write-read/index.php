<?php
/**
 * Filesystem Write / Read
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\ScrollBoxHtml;
use WebinoBaseLib\Html\TextHtml;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

/**
 * Checking whether
 * file exists.
 */
if ($app->file()->has('my/folder/test.txt')) {
    /**
     * Overwriting existing
     * files.
     *
     * Throws exception when file does not exist.
     */
    $app->file()->update('my/folder/test.txt', 'Test file contents ' . rand());

} else {
    /**
     * Adding new
     * files.
     *
     * Throws exception when file already exists.
     */
    $app->file()->write('my/folder/test.txt', 'Test file contents ' . rand());
}

/**
 * Writing file
 * contents.
 *
 * Never mind when file does exist or does not.
 */
$app->file()->put('my/folder/test-2.txt', 'Test-2 file contents ' . rand());

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining file
     * contents.
     */
    $file  = $event->getApp()->file()->read('my/folder/test.txt') . PHP_EOL;
    $file .= $event->getApp()->file()->read('my/folder/test-2.txt');

    $event->setResponseContent([
        'File contents:',
        new ScrollBoxHtml(nl2br(new TextHtml($file)), false),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
