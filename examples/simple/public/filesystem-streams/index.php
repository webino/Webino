<?php
/**
 * Filesystem Streams
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\TextHtml;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    (new Route('streamExample'))->setLiteral('/stream-response'),
]);

$app = Webino::application($config)->bootstrap();

// setup
$app->file()->write('my/folder/test.txt', 'Test file contents ' . rand());

/**
 * Reading files
 * using stream.
 */
$stream = $app->file()->readStream('my/folder/test.txt');

if ($app->file()->has('my/folder/test-2.txt')) {
    /**
     * Adding new files
     * using stream.
     *
     * Throws exception when file does not exist.
     */
    $app->file()->updateStream('my/folder/test-2.txt', $stream);

} else {
    /**
     * Adding new files
     * using stream.
     *
     * Throws exception when file exists.
     */
    $app->file()->writeStream('my/folder/test-2.txt', $stream);
}

/**
 * Writing file
 * using stream.
 *
 * Never mind when file does exist or does not.
 */
$app->file()->writeStream('my/folder/test-3.txt', $stream);

$app->bindRoute('streamExample', function (RouteEvent $event) {
    /**
     * Responding
     * using stream.
     */
    $event->setResponseStream($event->getApp()->file()->readStream('my/folder/test.txt'));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url('streamExample')->html('Click me!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();

// cleanup
$app->file()->deleteDir('my');
