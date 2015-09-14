<?php

namespace WebinoAppLib\View;

use WebinoAppLib\Service\Initializer\RoutingAwareInterface;
use WebinoAppLib\Service\Initializer\RoutingAwareTrait;
use WebinoDomLib\Event\RenderEvent;
use WebinoViewLib\Component\AbstractBaseViewComponent;
use WebinoViewLib\Component\OnRenderComponentInterface;
use WebinoViewLib\Feature\NodeView;

/**
 * Class RouteLinkComponent
 */
class RouteLinkComponent extends AbstractBaseViewComponent implements
    OnRenderComponentInterface,
    RoutingAwareInterface
{
    use RoutingAwareTrait;

    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node
            ->setLocator('route-link')
            ->setPriority(-100)
            ->setRename('a');
    }

    /**
     * @param RenderEvent $event
     */
    public function onRender(RenderEvent $event)
    {
        $node  = $event->getNode();
        $route = $node->getAttribute('route');

        $node
            ->setAttribute('href', $this->getRouter()->url($route))
            ->setAttribute('route', null);
    }
}
