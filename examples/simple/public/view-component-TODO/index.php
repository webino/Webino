<?php
/**
 * View Component
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;
use WebinoDomLib\Event\RenderEvent;
use WebinoViewLib\Component\AbstractViewComponent;
use WebinoViewLib\Component\OnRenderComponentInterface;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;

require __DIR__ . '/../../vendor/autoload.php';

// TODO

class MyViewComponent extends AbstractViewComponent implements
    OnRenderComponentInterface
{
    public function configure(NodeView $node)
    {
        $node
            ->setLocator('route-link')
            ->setRename('a')
            ->setAttribute('href', 'http://webino.sk')
            ->setValue('Click me!');

    }

    public function onRender(RenderEvent $event)
    {
        $event->getNode()
            ->setValue('Hello ' . time())
            ->setAttribute('style', 'text-decoration: underline');
    }
}

class ContactFormComponent extends AbstractViewComponent implements
    OnRenderComponentInterface
{
    public function configure(NodeView $node)
    {
        $node
            ->setLocator('contact-form')
            ->setRename('form');

    }

    public function onRender(RenderEvent $event)
    {
//        $event->getNode()
//            ->setValue('Hello ' . time())
//            ->setAttribute('style', 'text-decoration: underline');
    }
}



$config = Webino::config([
    /**
     * Configuring view
     * response route.
     */
    (new Route('viewTest'))->setLiteral('/view-test'),

    new CommonView([
        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<route-link/><view snippet="view/my/snippets/header"/><contact-form/>'),

        new MyViewComponent,
        new ContactFormComponent,
    ]),
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
