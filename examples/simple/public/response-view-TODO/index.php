<?php
/**
 * Response View
 * Webino example
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

$config = Webino::config([
    /**
     * Configuring view
     * response route.
     */
    (new Route('viewTest'))->setLiteral('/view-test'),

    new CommonView([
        (new NodeView('test-body'))
            ->setLocator('body')
            ->setHtml(new Html\Title('Hello Webino!')),
    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('viewTest', function (RouteEvent $event) {
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
    $event->setResponseContent([
        $event->getApp()->url('viewTest')->html('View response!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
