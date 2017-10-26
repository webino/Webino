<?php
/**
 * Events Aware
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;
use WebinoEventLib\Event;
use WebinoEventLib\EventsAwareInterface;
use WebinoEventLib\EventsAwareTrait;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom event
 */
class MyServiceEvent extends Event
{
    /**
     * @var string
     */
    private $responseText;

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

/**
 * Custom events aware
 */
class MyService implements EventsAwareInterface
{
    use EventsAwareTrait;

    public function doSomething()
    {
        /**
         * Triggering
         * custom event.
         */
        $params = ['responseText' => 'Hello'];
        $this->getEvents()->trigger(__FUNCTION__, $this, $params);
    }

    public function doSomethingDifferent()
    {
        /**
         * Triggering custom
         * event object.
         */
        $event = new MyServiceEvent(__FUNCTION__, $this);
        $event->setResponseText('Webino!');
        $this->getEvents()->trigger($event);
    }
}

$config = Webino::config([
    /**
     * Configuring
     * custom service.
     */
    new Service(MyService::class),
]);

$app = Webino::application($config)->bootstrap();

/** @var MyService $myService */
$myService = $app->get(MyService::class);

/**
 * Binding to
 * custom event.
 */
$myService->getEvents()->attach('doSomething', function (Event $event) use ($app) {
    $app->set('responseText', new Html\Text($event->getParam('responseText')));
});

/**
 * Binding to custom
 * event object.
 */
$myService->getEvents()->attach('doSomethingDifferent', function (MyServiceEvent $event) use ($app) {
    $app->get('responseText')->setValue('%s ' . $event->getResponseText());
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) use ($myService) {
    /**
     * Calling custom
     * service methods.
     */
    $myService->doSomething();
    $myService->doSomethingDifferent();

    $event->setResponseContent([
        $event->getApp()->get('responseText'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
