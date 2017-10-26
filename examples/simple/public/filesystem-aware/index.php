<?php
/**
 * Filesystem Aware
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBox;
use WebinoFilesystemLib\FilesystemAwareInterface;
use WebinoFilesystemLib\FilesystemAwareTrait;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom filesystem aware
 */
class MyService implements FilesystemAwareInterface
{
    use FilesystemAwareTrait;

    public function doSomething()
    {
        $this->getFilesystem()->put('my/folder/test.txt', 'Test file contents ' . rand());
    }
}

/**
 * Custom service factory
 */
class MyServiceFactory extends AbstractFactory
{
    protected function create()
    {
        $myService = new MyService;

        /**
         * Injecting filesystem
         * into custom service.
         */
        $myService->setFilesystem($this->getApp()->file());

        return $myService;
    }
}

$config = Webino::config([
    /**
     * Configuring custom
     * service factory.
     */
    new Service(MyService::class, MyServiceFactory::class),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /** @var MyService $myService */
    $myService = $event->getApp()->get(MyService::class);

    /**
     * Calling custom
     * service method.
     */
    $myService->doSomething();

    /**
     * Obtaining file
     * contents.
     */
    $file = $event->getApp()->file()->read('my/folder/test.txt');

    $event->setResponseContent([
        'File contents:',
        new ScrollBox(nl2br(new Html\Text($file))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
