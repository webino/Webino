<?php

namespace WebinoViewLib\Component;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Feature\HttpListener;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoDomLib\Dom\Config\SpecConfigAggregateInterface;
use WebinoDomLib\Dom\NodeInterface;
use WebinoDomLib\Event\RenderEvent;
use WebinoEventLib\ListenerAggregateTrait;
use WebinoViewLib\Feature\NodeView;
use WebinoViewLib\Feature\ViewListener;
use Zend\EventManager\ListenerAggregateInterface;

/**
 * Class AbstractViewComponent
 */
abstract class AbstractViewComponent extends AbstractBaseViewComponent implements
    ComponentStateInterface
{
    use ComponentStateTrait;

    // TODO concept
    public function getIndex()
    {
        return 0;
    }

    /**
     * @TODO concept
     * @var RenderEvent
     */
    private $renderEvent;

    /**
     * TODO concept
     * @param RenderEvent $event
     */
    protected function setRenderEvent(RenderEvent $event)
    {
        $this->renderEvent = $event;
    }

    /**
     * TODO concept
     * @return RenderEvent
     */
    protected function getRenderEvent()
    {
        return $this->renderEvent;
    }


    /**
     * @TODO concept
     */
//    public function __clone()
//    {
//        $this->state = clone $this->getState();
//    }
}
