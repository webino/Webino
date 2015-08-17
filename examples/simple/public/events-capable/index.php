<?php
/**
 * Events Capable
 * Webino example
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\TextHtml;
use WebinoEventLib\Event;
use WebinoEventLib\EventManagerAwareInterface;
use WebinoEventLib\EventManagerAwareTrait;

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
 * Custom events capable
 */
class MyService implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    public function doSomething()
    {
        /**
         * Triggering
         * custom event.
         */
        $params = ['responseText' => 'Hello'];
        $this->getEventManager()->trigger(__FUNCTION__, $this, $params);
    }

    public function doSomethingDifferent()
    {
        /**
         * Triggering custom
         * event object.
         */
        $event = new MyServiceEvent(__FUNCTION__, $this);
        $event->setResponseText('Webino!');
        $this->getEventManager()->trigger($event);
    }
}

$app = Webino::application()->bootstrap();

$myService = new MyService;

/**
 * Binding to
 * custom event.
 */
$myService->getEventManager()->attach('doSomething', function (Event $event) use ($app) {
    $app->set('responseText', new TextHtml($event->getParam('responseText')));
});

/**
 * Binding to custom
 * event object.
 */
$myService->getEventManager()->attach('doSomethingDifferent', function (MyServiceEvent $event) use ($app) {
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
