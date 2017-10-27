<?php
/**
 * Webino Credits
 * Kudos to all of you
 */

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\ViewResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoAppLib\Service\Credits;
use WebinoAppLib\View\SourcePreviewComponent;
use WebinoDomLib\Event\RenderEvent;
use WebinoHtmlLib\Html;
use WebinoViewLib\Component\AbstractViewComponent;
use WebinoViewLib\Component\OnDispatchInterface;
use WebinoViewLib\Component\Stylesheet;
use WebinoViewLib\Feature\CommonView;
use WebinoViewLib\Feature\NodeView;

require __DIR__ . '/../../vendor/autoload.php';

class CreditsComponent extends AbstractViewComponent implements OnDispatchInterface
{
    /**
     * Vendor dir
     */
    const DIR = '../../../../vendor';

    /**
     * Credits HTML
     *
     * @var string
     */
    private $html;

    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node
            ->setLocator('credits')
            ->setRename('div')
            ->setAddClass('list-group text-center');
    }

    /**
     * @param DispatchEvent $event
     */
    public function onDispatch(DispatchEvent $event)
    {
        if (!is_dir($this::DIR)) {
            return;
        }

        /** @var Credits $credits */
        $credits = $event->getApp()->get(Credits::class);
        if (!$credits) {
            return;
        }

        $html = '';
        foreach ($credits->getCredits($this::DIR) as $item) {

            $html .= (new Html\Block('0 1'))
                ->setClass('list-group-item')
                ->format([
                    new Html\Text(new Html\Strong($item[0])),
                    new Html\Text($item[1])
                ]);
        }

        $this->html = $html;
    }

    /**
     * @param RenderEvent $event
     */
    public function onRender(RenderEvent $event)
    {
        $event->getNode()->setHtml($this->html);
    }
}

$config = Webino::config([

    new CommonView([
        new Stylesheet\BootstrapV3,
        new SourcePreviewComponent(__FILE__),

        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<div class="container"><intro/><credits/><source-preview/></div>'),

        (new NodeView('intro'))
            ->setLocator('intro')
            ->setRename('div')
            ->setHtml('<div class="page-header text-center"><h1>Webino Credits</h1><copyright/></div><note/>')
            ->setView([
                (new NodeView('copyright'))
                    ->setLocator('copyright')
                    ->setRename('div')
                    ->setHtml([
                        (new Html\Text(':vendor (:link)'))
                            ->format([
                                ':vendor' => Credits::VENDOR_COPYRIGHT,
                                ':link'   => new Html\Url(Credits::VENDOR_URL),
                            ]),

                        new Html\Text(
                            (new Html\Html('<strong>Author:</strong> :name (:link)'))
                                ->format([
                                    ':name' => Credits::AUTHOR_NAME,
                                    ':link' => new Html\Url(Credits::AUTHOR_URL),
                                ])
                        ),
                    ]),

                (new NodeView('note'))
                    ->setLocator('note')
                    ->setRename('p')
                    ->setAddClass('alert alert-info text-center')
                    ->setValue([
                        'Webino™ is brought to you thanks to authors and contributors ',
                        'of following third-party libraries also.',
                    ])
            ]),

        new CreditsComponent,
    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse(new ViewResponse);
});

$app->dispatch();
