<?php
/**
 * Segment Route
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Listener;
use WebinoAppLib\Listener\RouteListenerTrait;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;
use WebinoConfigLib\Feature\Route;
use WebinoEventLib\AbstractListener;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Listener aggregate
 */
class MyListener extends AbstractListener
{
    use RouteListenerTrait;

    protected function init()
    {
        /**
         * Handling default route.
         */
        $this->listen(DefaultRoute::class, function (RouteEvent $event) {
            $event->setResponse([
                new Html\Text('Hello Webino!'),
                $event->getApp()->url('myRoute')->html('Go to MyRoute with default param'),
                new SourcePreview(__FILE__),
            ]);
        });

        /**
         * Handling custom route.
         */
        $this->listenRoute('myRoute', function (RouteEvent $event) {

            /**
             * Obtaining route
             * parameter value.
             */
            $requiredParam = $event->getParam('requiredParam');
            $optionalParam = $event->getParam('optionalParam');

            $event->setResponse([
                new Html\Text('My Route Example!'),
                new Html\Text('Required parameter value: ' . $requiredParam),
            ]);

            if (isset($optionalParam)) {
                $event->setResponse([
                    new Html\Text('Optional parameter value: ' . $optionalParam),
                    $event->getApp()->url('myRoute', ['requiredParam' => 'custom-param'])
                        ->html('Go to MyRoute with custom param'),
                ]);

            } elseif ('custom-param' !== $requiredParam) {
                $event->setResponse(
                    $event->getApp()->url('myRoute', ['optionalParam' => 'optional-param'])
                        ->html('Go to MyRoute with optional param')
                );
            }

            $event->setResponse([
                new Html\HorizontalLine,
                $event->getApp()->url(DefaultRoute::class)->html('Go Home'),
            ]);
        });
    }
}

$config = Webino::config([
    new Listener(MyListener::class),
    /**
     * Adding segment
     * route via config.
     */
    (new Route('myRoute'))
        ->setSegment('/:requiredParam[/:optionalParam]')
        ->setDefaults(['requiredParam' => 'default-param']),
        // TODO constraints
]);

Webino::application($config)->bootstrap()->dispatch();
