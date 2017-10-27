<?php
/**
 * Events Bind App Bootstrap Core via Config
 * Webino Example
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\CoreListener;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoEventLib\AbstractListener;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom listener
 */
class MyListener extends AbstractListener
{
    const RESPONSE_TEXT = 'responseText';

    protected function init()
    {
        /**
         * Binding to
         * app bootstrap.
         */
        $this->listen(AppEvent::BOOTSTRAP, function (AppEvent $event) {
            $event->getApp()->set($this::RESPONSE_TEXT, 'Hello Webino!');
        });
    }
}

$config = Webino::config([
    /**
     * Configuring custom
     * core listener.
     */
    new CoreListener(MyListener::class),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        $event->getApp()->get(MyListener::RESPONSE_TEXT),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
