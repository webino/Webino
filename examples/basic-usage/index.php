<?php
/**
 * Advanced usage example index file
 */

use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature as AppFeature;
use WebinoAppLib\Listener\AbstractRouteListener;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature as ConfigFeature;

require 'vendor/autoload.php';

class MyCustomFeature extends ConfigFeature\AbstractFeature
{
    public function setAnything()
    {
        return $this;
    }
}

class MyCustomListener extends AbstractRouteListener
{
    public function init()
    {
        $this->listen(AppEvent::DISPATCH, function (DispatchEvent $event) {
            $event->setResponseContent($event->getApp()->file()->read('docs/common.html'));
        }, AppEvent::BEGIN);

        $this->listen(AppEvent::DISPATCH, function (DispatchEvent $event) {
            $event->setResponseContent($event->getApp()->file()->read('docs/footer.html'));
        }, AppEvent::FINISH);

        $this->listen(DefaultRoute::class, function (RouteEvent $event) {
            $event->setResponseContent([
                '<h1>Webino Application Basic Usage Example</h1>',
                $event->getApp()->url('myRoute')->html('My Route Example'),
                '<br />',
                $event->getApp()->url('myRuntimeRoute')->html('My Runtime Route Example')
            ]);
        });

        $this->listen(RouteEvent::MATCH, function (RouteEvent $event) {
            $routeName = $event->getRouteMatch()->getMatchedRouteName();
            if (DefaultRoute::class === $routeName) {
                $routeName = 'default';
            }

            $file = $event->getApp()->file();
            $path = 'docs/' . $routeName . '.html';

            if ($file->has($path)) {
                $docs = $file->read($path);
                $event->setResponseContent($docs);
            }
        }, RouteEvent::FINISH);

        $this->listen(RouteEvent::MATCH, function (RouteEvent $event) {
            if (DefaultRoute::class !== $event->getRouteMatch()->getMatchedRouteName()) {
                $event->setResponseContent($event->getApp()->url(DefaultRoute::class)->html('Go Home'));
            }
        }, RouteEvent::FINISH);

        $this->listenRoute('myRoute', function (RouteEvent $event) {
            $event->setResponseContent('<h1>My Route Example Content</h1>');
        });

        $this->listenRoute('myRuntimeRoute', function (RouteEvent $event) {
            $event->setResponseContent([
                '<h1>My Runtime Route Example Content</h1>',
            ]);
        });
    }
}


$config = new CoreConfig([
    new ConfigFeature\Log,
    new ConfigFeature\FirePhpLog,
    new AppFeature\FilesystemCache,

    (new MyCustomFeature)
        ->setAnything(),

    new AppFeature\Listener(MyCustomListener::class),

    (new ConfigFeature\Route('myRoute'))->setLiteral('/my-route'),
]);


$appCore = Webino::application($config);
$app = $appCore->bootstrap();

// runtime route example
$app->route('myRuntimeRoute')->setLiteral('/my-runtime-route');

require __DIR__ . '/dispatch.php';

$app->dispatch();
