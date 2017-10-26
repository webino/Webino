<?php

namespace WebinoDomLib\Event;

use WebinoDomLib\Dom\Config\SpecInterface;
use WebinoDomLib\Dom\Element;
use WebinoDomLib\Dom\NodeInterface;
use WebinoDomLib\Dom\Renderer;
use WebinoEventLib\Event;
use WebinoViewLib\ViewState;

/**
 * Class RenderEvent
 */
class RenderEvent extends Event
{
    /**
     * @var NodeInterface
     */
    private $node;

    /**
     * @var NodeInterface[]
     */
    private $nodes = [];

    /**
     * @var SpecInterface
     */
    private $spec;

    /**
     * @var ViewState
     */
    private $state;

    /**
     * @var self
     */
    private $parent;

    /**
     * @param Renderer $target
     * @param NodeInterface $node
     * @param SpecInterface $spec
     * @param self|null $parent
     */
    public function __construct(Renderer $target, NodeInterface $node, SpecInterface $spec, self $parent = null)
    {
        parent::__construct(static::class, $target);
        $this->node   = $node;
        $this->spec   = $spec;
        $this->parent = $parent;
    }

    /**
     * @return RenderEvent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param string|null $name
     * @return Element
     */
    public function getNode($name = null)
    {
        if ($name) {
            return $this->nodes[$name];
        }
        return $this->node;
    }

    /**
     * @param NodeInterface $node
     * @param string|null $name
     * @return $this
     */
    public function setNode($node, $name = null)
    {
        if ($name) {
            $this->nodes[$name] = $node;
        } else {
            $this->node = $node;
        }
        return $this;
    }

    /**
     * @return \WebinoDomLib\Dom\Config\Spec
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * @return ViewState
     */
    public function getState()
    {
        if (null === $this->state) {
            $this->setState(new ViewState);
        }
        return $this->state;
    }

    /**
     * @param ViewState $state
     * @return $this
     */
    public function setState(ViewState $state)
    {
        $this->state = $state;
        return $this;
    }
}
