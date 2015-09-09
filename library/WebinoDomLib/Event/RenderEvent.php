<?php

namespace WebinoDomLib\Event;

use WebinoDomLib\Dom\Config\SpecInterface;
use WebinoDomLib\Dom\NodeInterface;
use WebinoDomLib\Dom\Renderer;
use WebinoEventLib\Event;

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
     * @var SpecInterface
     */
    private $spec;

    /**
     * @param Renderer $target
     * @param NodeInterface $node
     * @param SpecInterface $spec
     */
    public function __construct(Renderer $target, NodeInterface $node, SpecInterface $spec)
    {
        parent::__construct(static::class, $target);
        $this->node = $node;
        $this->spec = $spec;
    }

    /**
     * @return NodeInterface
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return SpecInterface
     */
    public function getSpec()
    {
        return $this->spec;
    }
}
