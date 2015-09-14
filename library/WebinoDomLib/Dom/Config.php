<?php

namespace WebinoDomLib\Dom;

use WebinoConfigLib\AbstractConfig;
use WebinoConfigLib\Feature\FeatureInterface;
use Zend\Stdlib\PriorityQueue;

/**
 * Class Config
 */
class Config extends AbstractConfig implements
    FeatureInterface
{
    /**
     * Spec list.
     *
     * @var array
     */
    private $items = [];

    /**
     * @var PriorityQueue
     */
    private $queue;

    /**
     * @var array
     */
    private $toMerge = [];

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param string $name Spec name.
     * @return Config\SpecConfig
     */
    public function get($name)
    {
        if (empty($this->items[$name])) {
            return $this->set($name);
        }
        return $this->items[$name];
    }

    /**
     * @param string $name Spec name.
     * @return Config\SpecConfig
     */
    public function set($name)
    {
        if (is_object($name) && $name instanceof Config\AbstractSpecConfig) {
            $this->items[$name->getName()] = $name;
            return $name;
        }

        if (empty($this->items[$name])) {
            $this->items[$name] = new Config\SpecConfig($name);
        }
        return $this->items[$name];
    }

    /**
     * @return PriorityQueue
     */
    public function getQueue()
    {
        if (null === $this->queue) {
            $queue = new PriorityQueue;;
            foreach ($this->toArray() as $name => $item) {
                $spec = new Config\Spec($item, $name);
                $queue->insert($spec, $spec->getPriority());
            }
            $this->setQueue($queue);
        }
        return $this->queue;
    }

    /**
     * @param PriorityQueue $queue
     */
    private function setQueue(PriorityQueue $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @param array $cfg
     * @return $this
     */
    public function setToMerge(array $cfg)
    {
        $this->toMerge = array_replace_recursive($this->toMerge, $cfg);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->items as $name => $item) {
            if ($item instanceof Config\AbstractSpecConfig) {
                $result[$name] = $item->toArray();

            } elseif (is_array($item)) {
                $result[$name] = $item;
            }
        }
        return array_replace_recursive($result, $this->toMerge);
    }
}
