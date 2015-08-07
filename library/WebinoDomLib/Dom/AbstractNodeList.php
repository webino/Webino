<?php

namespace WebinoDomLib\Dom;

use ArrayIterator;
use ArrayObject;
use DOMNodeList;
use IteratorAggregate;
use IteratorIterator;
use WebinoDomLib\Exception\InvalidArgumentException;

/**
 * Class AbstractNodeList
 */
abstract class AbstractNodeList extends \DOMNodeList implements IteratorAggregate
{
    /**
     * @var IteratorIterator
     */
    protected $nodes;

    /**
     * @return IteratorIterator
     */
    public function getNodes()
    {
        if (null === $this->nodes) {
            $this->setNodes([]);
        }
        return $this->nodes;
    }

    /**
     * @param array|DOMNodeList|IteratorIterator $nodes
     * @return NodeList
     * @throws InvalidArgumentException
     */
    public function setNodes($nodes)
    {
        if ($nodes instanceof IteratorIterator) {
            $this->nodes  = $nodes;
            return $this;
        }

        if (is_array($nodes)) {
            $this->nodes = new IteratorIterator(new ArrayObject($nodes));
            return $this;
        }

        if ($nodes instanceof DOMNodeList) {
            $this->nodes = new IteratorIterator($nodes);
            return $this;
        }

        throw (new InvalidArgumentException)
            ->format('Expected nodes as % but got s', 'array|DOMNodelist|IteratorIterator', $nodes);
    }

    /**
     * @return \Traversable
     */
    public function getIterator()
    {
        return $this->getNodes()->getInnerIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function item($index)
    {
        $iterator = $this->nodes->getInnerIterator();
        if ($iterator instanceof DOMNodeList) {
            return $iterator->item($index);
        }

        if ($iterator instanceof ArrayIterator) {
            return $iterator->offsetGet($index);
        }

        // TODO exception
        e('TODO exception');
    }
}
