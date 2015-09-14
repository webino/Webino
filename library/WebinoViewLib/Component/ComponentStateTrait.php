<?php

namespace WebinoViewLib\Component;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Feature\HttpListener;
use WebinoAppLib\Service\Initializer\RoutingAwareTrait;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoDomLib\Dom\Config\SpecConfigAggregateInterface;
use WebinoDomLib\Dom\NodeInterface;
use WebinoDomLib\Event\RenderEvent;
use WebinoEventLib\ListenerAggregateTrait;
use WebinoViewLib\Feature\NodeView;
use WebinoViewLib\Feature\ViewListener;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Stdlib\CallbackHandler;

/**
 * Class ComponentStateTrait
 * @TODO concept
 */
trait ComponentStateTrait
{
    use RoutingAwareTrait;

    /**
     * @var \stdClass
     */
    private $state;

    /**
     * @TODO concept
     * @var NodeInterface[]
     */
    private $nodes = [];

    /**
     * @return RenderEvent
     */
    abstract protected function getRenderEvent();

    /**
     * TODO concept
     * @param DispatchEvent $event
     */
    public function onDispatchState(DispatchEvent $event)
    {
        // TODO resolve state
        $state = $event->getRequest()->getQuery()->counter[$this->getIndex()];

        empty($state) or $this->mergeState($state);
    }

    /**
     * @TODO concept
     * @param string $name Node name
     * @param string|\Closure $method
     * @return $this
     */
    public function onStateChange($name, $method)
    {
        // TODO create href concept
        $clone = clone $this;

        // TODO refactor
        if (is_string($method)) {
            $clone->$method();
        } elseif ($method instanceof \Closure) {
            call_user_func($method->bindTo($clone));
        } else {
            // TODO invalid argument exception
        }

        // TODO common
        $query = ['counter' => [$this->getIndex() => (array) $clone->getState()]];

        $href = $this->getRouter()->url()->setOption('query', $query);

        // TODO concept
        $node = $this->getRenderEvent()->getNode($name);
        $node->setAttribute('href', $href);

        return $this;
    }

    /**
     * @return \stdClass
     */
    public function getState()
    {
        if (null === $this->state) {
            $this->state = new \stdClass;
            $this->initState($this->state);
        }
        return $this->state;
    }

    /**
     * @param \stdClass $state
     * @return $this
     */
    public function setState(\stdClass $state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @param array|\stdClass $state
     * @return $this
     */
    public function mergeState($state)
    {
        $this->state = (object) array_replace_recursive((array) $this->getState(), (array) $state);
        return $this;
    }

    /**
     * @param \stdClass $state
     */
    public function initState(\stdClass $state)
    {
    }

    /**
     * @param string $name
     * @return ComponentNode
     */
//    protected function getNode($name)
//    {
//        if (empty($this->nodes[$name])) {
//            $this->nodes[$name] = new ComponentNode($this->getRenderEvent()->getNode($name), $this);
//        }
//        return $this->nodes[$name];
//    }

    /**
     * @TODO concept
     */
    public function __clone()
    {
        $this->state = clone $this->getState();
    }
}
