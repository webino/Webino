<?php
/**
 * View Layout
 * Webino Example
 */

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;
use WebinoViewLib\Component\AbstractViewComponent;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;
use WebinoViewLib\Feature\ViewTemplateHtml;
use WebinoViewLib\Feature\ViewTemplateMap;

require __DIR__ . '/../../vendor/autoload.php';

$config = new CoreConfig([
    new ViewTemplateMap(__DIR__ . '/view'),

    new ViewTemplateHtml('my/home', '<h1>My home page</h1><p>Home text bla bla...</p>'),

    new ViewTemplateHtml('my/my-route', '<h1>My route page</h1><p>Route text bla bla...</p>'),

    (new Route('my-route'))->setLiteral('/my-route'),

    new CommonView([

        (new NodeView('content'))
            ->setLocator('.content')
            ->setHtml('{$content}'),

        (new NodeView('home-link'))
            ->setLocator('.side-column nav')
            ->setHtml('{$_innerHtml} <route-link route="WebinoAppLib\Router\DefaultRoute">Go home</route-link>'),

        (new NodeView('my-route-link'))
            ->setLocator('.side-column nav')
            ->setHtml('{$_innerHtml} <route-link route="my-route">Go to my route</route-link>'),

    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('my-route', function (RouteEvent $event) {

    $response = new ViewResponse;

    // TODO common
    $response
        // TODO default layout config
        ->setLayout('my/layout')
        ->get('content')
        ->setSnippet('content', 'my/my-route');

    $event->setResponse($response);
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {

    $response = new ViewResponse;

    // TODO common
    $response
        // TODO default layout config
        ->setLayout('my/layout')
        ->get('content')
        ->setSnippet('content', 'my/home');

    $event->setResponse($response);

//    $event->setResponse([
//        'Hello Webino!',
//        new SourcePreview(__FILE__),
//    ]);
});

$app->dispatch();
