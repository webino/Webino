<?php

namespace WebinoDomLib\Dom;

use WebinoDomLib\State\Spec;
use Zend\Stdlib\PriorityQueue;

/**
 * Class State
 */
class State
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var PriorityQueue
     */
    private $queue;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return PriorityQueue
     */
    public function getQueue()
    {
        if (null === $this->queue) {
            $queue = new PriorityQueue;;
            foreach ($this->config as $options) {
                $spec = new Spec($options);
                $queue->insert($spec, $spec->getPriority());
            }
            $this->setQueue($queue);
        }
        return $this->queue;
    }

    /**
     * @param PriorityQueue $queue
     */
    private function setQueue($queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
