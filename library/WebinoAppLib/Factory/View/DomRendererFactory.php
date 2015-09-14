<?php

namespace WebinoAppLib\Factory\View;

use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\DefaultView;
use WebinoDomLib\Dom;
use WebinoDomLib\Event\RenderEvent;
use Zend\Mvc\Service\RoutePluginManagerFactory;
use Zend\Mvc\Service\RouterFactory as BaseRouterFactory;

/**
 * Class DomRendererFactory
 */
class DomRendererFactory extends AbstractFactory
{
    /**
     * Create DOM renderer
     *
     * @return Dom\Renderer
     */
    protected function create()
    {
        $renderer = new Dom\Renderer;
        $events   = $renderer->getEvents();

        // TODO constant
        $listeners = $this->getConfig(DefaultView::KEY)['listeners'];

        // TODO listeners debug profile
        //pd($listeners);

        foreach ($listeners as $class) {
            /** @var \Zend\EventManager\ListenerAggregateInterface $listener */
            $listener = $this->getServices()->get($class);
            $events->attachAggregate($listener);
        }

        return $renderer;
    }
}
