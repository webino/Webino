<?php
/**
 * View Component Counter
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoAppLib\View\SourcePreviewComponent;
use WebinoConfigLib\Feature\Route;
use WebinoDomLib\Event\RenderEvent;
use WebinoViewLib\Component\AbstractViewComponent;
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
            ->setReplace('<div><display/><plus/> | <minus/></div>')
            ->setView([
                (new NodeView('display'))
                    ->setRename('p'),

                (new NodeView('plus'))
                    ->setRename('a')
                    ->setValue('+'),

                (new NodeView('minus'))
                    ->setRename('a')
                    ->setValue('-'),
            ]);
    }

    public function onPlus()
    {
        $this->getState()->count++;
    }

    public function onRender(RenderEvent $event)
    {
        $event->getNode('display')->setValue($this->getState()->count);

        // update state via method
        $this->onStateChange('plus', 'onPlus');

        // opr via closure
        $this->onStateChange('minus', function () {
            $this->getState()->count--;
        });
    }
}

$config = Webino::config([
    new CommonView([
        new SourcePreviewComponent(__FILE__),

        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<counter/><source-preview/>'),

        new CounterComponent,
    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Responding
     * using view.
     */
    $event->setResponse(new ViewResponse);
});

$app->dispatch();
