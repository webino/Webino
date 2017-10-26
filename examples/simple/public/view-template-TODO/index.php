<?php
/**
 * View Template
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;
use WebinoViewLib\Feature\ViewTemplateHtml;

require __DIR__ . '/../../vendor/autoload.php';

// TODO


$config = Webino::config([
    /**
     * Configuring view
     * response route.
     */
    (new Route('viewTest'))->setLiteral('/view-test'),

    new CommonView([
        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<view snippet="my/snippets/header"/>'),
//            ->setHtml('<p class="snippet" snippet="my/snippets/header"/>'),

//        (new NodeView('snippet-example'))
//            ->setLocator('.snippet')
//            ->setSnippet('test', '{$_snippet}')
//            ->setReplace('{$test}')
//            ->setAttribute('class', 'main-header'),
//
//        (new NodeView('main-header'))
//            ->setLocator('.main-header')
//            ->setValue('{$_nodeValue} pokus {$_nodeValue} {$_class}'),
//            ->setReplace('<div></div>'),

        new \WebinoViewLib\Component\ViewSnippetComponent(),
    ]),

    new ViewTemplateHtml('my/snippets/header', '<header>This is HEADER!</header>'),
//    new ViewTemplateMap(__DIR__ . '/view'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('viewTest', function (RouteEvent $event) {
    /**
     * Responding using view
     * with custom component.
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
