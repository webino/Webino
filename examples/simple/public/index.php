<?php
/**
 * Webino Examples
 */

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoAppLib\View\SourcePreviewComponent;
use WebinoDomLib\Event\RenderEvent;
use WebinoHtmlLib\Html;
use WebinoViewLib\Component\AbstractViewComponent;
use WebinoViewLib\Component\OnDispatchInterface;
use WebinoViewLib\Component\Stylesheet;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Custom view component
 */
class ExamplesComponent extends AbstractViewComponent implements OnDispatchInterface
{
    /**
     * @var string
     */
    private $api;

    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node->setLocator('examples');
    }

    /**
     * @param DispatchEvent $event
     */
    public function onDispatch(DispatchEvent $event)
    {
        $examples = [];
        foreach ($event->getApp()->file()->listContents() as $info) {
            if ('dir' !== $info['type']) {
                continue;
            }

            list($section) = explode('-', $info['filename'], 2);
            $label = ucwords(str_replace('-', ' ', $info['filename']));
            $examples[ucfirst($section)][] = new Html\Url($info['filename'], $label) . new Html\LineBreak;
        }

        $this->api = '';
        foreach ($examples as $section => $items) {
            $this->api .= new Html\Title4($section);
            foreach ($items as $item) {
                $this->api .= $item;
            }
            $this->api .= new Html\LineBreak;
        }
    }

    /**
     * @param RenderEvent $event
     */
    public function onRender(RenderEvent $event)
    {
        $col = (new Html\Block)->setClass('col-md-4');

        $event->getNode()->replace([
            (new Html\Block([
                new Html\Title('Webino Examples'),

                (new Html\Text('Showcase of :link prototype usage.'))
                    ->format([':link' => new Html\Url('https://github.com/webino/Webino', 'Webino™')])
            ]))->setClass('text-center'),

            new Html\HorizontalLine,
            (clone $col)->setValue(new Html\FieldSet(new Html\Title2('API'), new Html\Html($this->api))),
            (clone $col)->setValue(new Html\FieldSet(new Html\Title2('Cookbook'), 'TODO...')),
            (clone $col)->setValue(new Html\FieldSet(new Html\Title2('Applications'), 'TODO...')),
        ]);
    }
}

$config = Webino::config([
    new CommonView([
        new Stylesheet\BootstrapV3,
        new SourcePreviewComponent(__FILE__),

        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<div class="container jumbotron"><examples/></div><source-preview/>'),

        new ExamplesComponent,
    ]),
]);

$app = Webino::application($config, Webino::debugger(Webino::debuggerOptions()->setBar()))->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse(new ViewResponse);
});

$app->dispatch();
