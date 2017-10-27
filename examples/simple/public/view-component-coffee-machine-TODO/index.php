<?php
/**
 * View Component Coffee Machine
 * Webino Example
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
use WebinoViewLib\Feature\ViewTemplateMap;

require __DIR__ . '/../../vendor/autoload.php';

// TODO

class CoffeeMachineComponent extends AbstractViewComponent implements
    OnRenderComponentInterface,
    \WebinoViewLib\Component\OnDispatchInterface,
    \WebinoAppLib\Service\Initializer\RoutingAwareInterface
{
    use WebinoAppLib\Service\Initializer\RoutingAwareTrait;
    use \WebinoAppLib\Listener\RouteListenerTrait;

    private function getIndex()
    {
        return 0;
    }

    public function configure(NodeView $node)
    {
        $node
            ->setLocator('coffee-machine')
            ->setSnippet('snippet', 'my/snippets/coffee-machine')
            ->setReplace('{$snippet}')
            ->setView([
                (new NodeView('display'))
                    ->setRename('p')
                    ->setValue('Coffee Machine Display'),

                (new NodeView('buy'))
                    ->setRename('a')
                    ->setAttribute('href', '#')
                    ->setValue('Buy coffee'),
            ]);
    }

    public function onBuyCoffee(RouteEvent $event)
    {
        // TODO concept
        $this->setState();
    }

    public function onDispatch(\WebinoAppLib\Event\DispatchEvent $event)
    {
        // TODO
        $state = $event->getRequest()->getQuery()->coffeeMachine[$this->getIndex()];

        dd($state);
    }

    // TODO concept
    public function getInitialState()
    {

    }

    public function onRender(RenderEvent $event)
    {
        // TODO common
        $href = $this->getRouter()->url(null)->setOption('query', ['coffeeMachine' => [$this->getIndex() => ['bought' => 1]]]);
//        die($href);
        $event->getNode('buy')->setAttribute('href', $href);
    }

    /**
     * Initialize listener
     */
    protected function init()
    {
        parent::init();

        // TODO common
//        $this->listenRoute('coffeeMachineBuy', 'onBuyCoffee');
//        $this->listen(RouteEvent::MATCH, 'onBuyCoffee');
    }


    /**
     * @return array
     */
    public function toArray()
    {
        // TODO common
        return parent::toArray();
//        return parent::toArray() + (new Route('coffeeMachineBuy'))->setLiteral('/coffee-machine-buy')->toArray();
    }
}

$config = Webino::config([
    /**
     * Configuring view
     * response route.
     */
    (new Route('viewTest'))->setLiteral('/view-test'),

    new ViewTemplateMap(__DIR__ . '/view'),

    new CommonView([
        (new NodeView('content'))
            ->setLocator('body')
            ->setHtml('<coffee-machine/>'),

        new CoffeeMachineComponent,
    ]),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('viewTest', function (RouteEvent $event) {
    /**
     * Responding
     * using view.
     */
    $event->setResponse(new ViewResponse);
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        $event->getApp()->url('viewTest')->html('View response!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
