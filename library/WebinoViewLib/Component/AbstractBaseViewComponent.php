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
 * Class AbstractBaseViewComponent
 */
abstract class AbstractBaseViewComponent implements
    FeatureInterface,
    ListenerAggregateInterface,
    SpecConfigAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @param NodeView $node
     */
    abstract public function configure(NodeView $node);

    /**
     * Initialize listener
     * @TODO concept
     */
    protected function init()
    {
        // TODO refactor

        $callback = function (DispatchEvent $event) {
            // TODO
            (isset($this->x) && ($this instanceof OnDispatchInterface || method_exists($this, 'onDispatchState')))
                and call_user_func($this->x, $event);
        };

        // TODO
        ($this instanceof OnDispatchInterface || method_exists($this, 'onDispatchState'))
            and $this->listen(AppEvent::DISPATCH, $callback, AppEvent::FINISH);

        ($this instanceof OnRenderComponentInterface)
            and $this->listen(static::class, function (RenderEvent $event) {

            // TODO redesign

                if (($this instanceof OnDispatchInterface)
                    // TODO
                    || method_exists($this, 'onDispatchState')
                ) {
                    $this->x = function (DispatchEvent $dispatchEvent) use ($event) {

                        // TODO
                        ($this instanceof OnDispatchInterface) and $this->onDispatch($dispatchEvent);

                        // TODO
                        method_exists($this, 'onDispatchState') and $this->onDispatchState($dispatchEvent);

                        // TODO
                        method_exists($this, 'setRenderEvent') and $this->setRenderEvent($event);
                        $this->onRender($event);
                    };
                } else {
                    // TODO concept
                    method_exists($this, 'setRenderEvent') and $this->setRenderEvent($event);
                    $this->onRender($event);
                }
            });
    }

    /**
     * @return string
     */
    protected function getSpecName()
    {
        return static::class;
    }

    /**
     * @return NodeView
     */
    public function getSpecConfig()
    {
        $node = new NodeView($this->getSpecName());
        $this->configure($node);

        ($this instanceof OnRenderComponentInterface)
            and $node->setOptions(['trigger' => [static::class => static::class]]);

        return $node;
    }

    /**
     * @TODO concept
     * @return array
     */
    public function toArray()
    {
        $cfg = [];

        // TODO
        if (($this instanceof OnDispatchInterface) || method_exists($this, 'onDispatchState')) {
            $cfg += (new HttpListener(static::class))->toArray();
        }

        if (($this instanceof OnRenderComponentInterface)) {
            $cfg += (new ViewListener(static::class))->toArray();
        }

        return $cfg;
    }
}
