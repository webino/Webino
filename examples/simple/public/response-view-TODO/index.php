<?php
/**
 * Response View
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example routes
 */
abstract class MyRoutes
{
    const VIEW_TEST = 'viewTest';
}

$config = Webino::config([
    /**
     * Configuring view
     * response route.
     */
    (new Route(MyRoutes::VIEW_TEST))->setLiteral('/view-test'),

    new CommonView([
        (new NodeView('test-body'))
            ->setLocator('body')
            ->setHtml(new Html\Title('Hello Webino!')),
    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute(MyRoutes::VIEW_TEST, function (RouteEvent $event) {
    /**
     * Responding
     * using view.
     */

    // TODO

    $response = new ViewResponse;

//    $response->getCfg()
//        ->set('test-body')
//        ->setLocator('body')
//        ->setHtml(new \WebinoHtmlLib\TitleHtml('Hello Webino!'));
//        ->setValue('Hello Webino!');

//    $response->setLayout('example/layout');

//    $response->setLayoutHtml('<html></html>');

//    $response->addCfg('example/test');

//    $response->setCfgSpec([
        // TODO...
//    ]);

    $event->setResponse($response);
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        $event->getApp()->url(MyRoutes::VIEW_TEST)->html('View response!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
