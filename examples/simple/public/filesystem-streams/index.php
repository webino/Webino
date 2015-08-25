<?php
/**
 * Filesystem Streams
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\StreamResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\LineBreakHtml;
use WebinoHtmlLib\TextHtml;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    (new Route('streamExample'))->setLiteral('/stream-response'),
    (new Route('streamExampleDownload'))->setLiteral('/stream-response-download'),
]);

$app = Webino::application($config)->bootstrap();

// setup
$app->file()->deleteDir('my');
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
    $event->setResponse(new StreamResponse('my/folder/test.txt'));
});

$app->bindRoute('streamExampleDownload', function (RouteEvent $event) {
    /**
     * Responding using
     * download stream.
     */
    $event->setResponse((new StreamResponse('my/folder/test.txt'))->setForceDownload());
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url('streamExample')->html('Click me!'),
        new LineBreakHtml,
        $event->getApp()->url('streamExampleDownload')->html('Download me!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();

// cleanup
$app->file()->deleteDir('my');
