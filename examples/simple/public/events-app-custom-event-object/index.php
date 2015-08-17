<?php
/**
 * Events App Custom Event Object
 * Webino example
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom app event
 */
class MyEvent extends AppEvent
{
    /**
     * @var string
     */
    private $responseText;

    /**
     * @param AppEvent $event
     */
    public function __construct(AppEvent $event)
    {
        parent::__construct(self::class, $event->getApp(), $event->getParams());
    }

    /**
     * @return string
     */
    public function getResponseText()
    {
        return $this->responseText;
    }

    /**
     * @param string $responseText
     * @return $this
     */
    public function setResponseText($responseText)
    {
        $this->responseText = (string) $responseText;
        return $this;
    }
}

$app = Webino::application()->bootstrap();

/**
 * Binding to
 * custom event.
 */
$app->bind(MyEvent::class, function (MyEvent $event) {
    $event->setResponseText('Hello Webino!');
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Emitting
     * custom event.
     */
    $myEvent = new MyEvent($event);
    $event->getApp()->emit($myEvent);

    $event->setResponseContent([
        $myEvent->getResponseText(),
        new SourcePreview(__FILE__)
    ]);
});

$app->dispatch();
