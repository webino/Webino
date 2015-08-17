<?php
/**
 * Events Bind App Bootstrap Core via Config
 * Webino example
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
    protected function init()
    {
        /**
         * Binding to
         * app bootstrap.
         */
        $this->listen(AppEvent::BOOTSTRAP, function (AppEvent $event) {
            $event->getApp()->set('responseText', 'Hello Webino!');
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
    $event->setResponseContent([
        $event->getApp()->get('responseText'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
