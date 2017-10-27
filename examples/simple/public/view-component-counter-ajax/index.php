<?php
/**
 * View Component Counter Ajax
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoAppLib\View\SourcePreviewComponent;
use WebinoDomLib\Event\RenderEvent;
use WebinoViewLib\Component\AbstractViewComponent;
use WebinoViewLib\Component\Javascript;
use WebinoViewLib\Component\Stylesheet;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom view component
 */
class CounterComponent extends AbstractViewComponent
{
    public function initState(\stdClass $state)
    {
        $state->count = 0;
    }

    public function configure(NodeView $node)
    {
        $node
            ->setLocator('counter')
            ->setReplace('<div class="ajax-fragment btn-group"><display/><plus/><minus/></div>')
            ->setView([
                (new NodeView('display'))
                    ->setRename('span')
                    ->setAddClass('btn btn-default disabled'),

                (new NodeView('plus'))
                    ->setRename('a')
                    ->setAddClass('btn btn-info ajax')
                    ->setValue('+'),

                (new NodeView('minus'))
                    ->setRename('a')
                    ->setAddClass('btn btn-info ajax')
                    ->setValue('-'),
            ]);
    }

    public function onRender(RenderEvent $event)
    {
        $event->getNode('display')
            ->setValue($this->getState()->count);

        $this->onStateChange('plus', function () {
            $this->getState()->count++;
        });

        $this->onStateChange('minus', function () {
            $this->getState()->count--;
        });
    }
}

$config = Webino::config([
    new CommonView([
        new Stylesheet\BootstrapV3,
        new Javascript\WebinoAjaxJQueryV0,
        new SourcePreviewComponent(__FILE__),

        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<div class="container jumbotron"><counter/></div><source-preview/>'),

        new CounterComponent,
    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse(new ViewResponse);
});

$app->dispatch();
