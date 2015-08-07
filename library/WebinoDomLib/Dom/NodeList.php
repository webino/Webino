<?php

namespace WebinoDomLib\Dom;

use DOMNodeList;
use IteratorIterator;

/**
 * Class NodeList
 */
class NodeList extends AbstractNodeList
{
    /**
     * @var IteratorIterator
     */
    protected $nodes;

    /**
     * @param array|DOMNodeList $nodes DOMNodes in array or DOMNodelist.
     */
    public function __construct($nodes = null)
    {
        empty($nodes) or $this->setNodes($nodes);
    }

    /**
     * @param array|DOMNodeList $nodes DOMNodes in array or DOMNodelist.
     * @return NodeList
     */
    public function create($nodes)
    {
        return new self($nodes);
    }

    /**
     * @param string|array $locator
     * @return self
     */
    public function locate($locator)
    {
        $nodes = [];
        $this->each(function (Element $node) use ($locator, &$nodes) {
            foreach ($node->locate($locator) as $subNode) {
                $nodes[] = $subNode;
            }
        });
        return $this->create($nodes);
    }

    /**
     * @param callable $callback function (\WebinoDomLib\Dom\NodeInterface $node) {}
     * @return self
     */
    public function each(callable $callback)
    {
        foreach ($this as $node) {
            if ($node instanceof Element) {
                call_user_func($callback, $node);
            }
        }
        return $this;
    }

    /**
     * @param array $items
     * @param callable|null $callback
     * @return self
     */
    public function loop(array $items, callable $callback = null)
    {
        foreach ($this as $node) {
            foreach ($items as $item) {
                $newNode = $node->parentNode->appendChild(clone $node);
                is_callable($callback) and call_user_func($callback, $this->create([$newNode]), $item);
            }
        }

        $this->remove();
        return $this;
    }

    /**
     * @param string $value Node value.
     * @param callable|null $callback function ($value, \WebinoDomLib\Dom\NodeInterface $node) {}
     * @return self
     */
    public function setValue($value, callable $callback = null)
    {
        $isCallable = is_callable($callback);
        $this->each(function (Element $node) use ($value, $callback, $isCallable) {
            $nodeValue = $isCallable ? call_user_func($callback, $value, $node) : $value;
            if (!empty($nodeValue)) {
                $node->setValue($nodeValue);
            }
        });

        return $this;
    }

    /**
     * @param array $attributes
     * @param callable|null $callback
     * @return self
     */
    public function setAttributes(array $attributes, callable $callback = null)
    {
        $isCallable = is_callable($callback);
        $this->each(function (Element $node) use ($attributes, $callback, $isCallable) {
            foreach ($attributes as $name => $value) {

                $attribute = $isCallable ? call_user_func($callback, $name, $value, $node) : $value;
                if (empty($value) && !is_numeric($value)) {
                    $node->removeAttribute($name);
                } else {
                    $node->setAttribute($name, $attribute);
                }
            }
        });

        return $this;
    }

    /**
     * @param string $html Valid XHTML code.
     * @param callable|null $callback function ($html, \WebinoDomLib\Dom\NodeInterface $node) {}
     * @return self
     */
    public function setHtml($html, callable $callback = null)
    {
        $isCallable = is_callable($callback);
        $this->each(function (Element $node) use ($html, $callback, $isCallable) {
            $nodeHtml = $isCallable ? call_user_func($callback, $html, $node) : $html;
            if (!empty($nodeHtml)) {
                $node->setHtml($nodeHtml);
            }
        });

        return $this;
    }

    /**
     * Returns the node body html
     *
     * @return string
     */
    public function getInnerHtml()
    {
        $html = '';
        $this->each(function (Element $node) use (&$html) {
            $html .= $node->getInnerHtml();
        });
        return $html;
    }

    /**
     * Returns the node html
     *
     * @return string
     */
    public function getOuterHtml()
    {
        $html = '';
        $this->each(function (Element $node) use (&$html) {
            $html .= $node->getOuterHtml();
        });
        return $html;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        foreach ($this as $node) {
            if ($node instanceof Element && !$node->isEmpty()) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param NodeList $children
     * @return self
     */
    public function appendChild(NodeList $children)
    {
        $nodes = [];

        $this->each(function (Element $node) use ($children, &$nodes) {
            foreach ($children as $child) {
                $nodes[] = $node->appendChild($child);
            }
        });

        return $this->create($nodes);
    }

    public function appendNext(NodeList $children)
    {
        $nodes = [];

        $this->each(function (Element $node) use ($children, &$nodes) {
            foreach ($children as $child) {
                // TODO insert before
                $nodes[] = $node->parentNode->appendChild(clone $child);
            }
        });

        return $this->create($nodes);
    }
    /**
     * @return self
     */
    public function remove()
    {
        $this->each(function (Element $node) {
            $node->parentNode->removeChild($node);
        });
        return $this;
    }

    /**
     * @return self Clone.
     */
    public function detach()
    {
        $clone = clone $this;
        $this->remove();
        return $clone;
    }

    /**
     * @return string HTML code.
     */
    public function show()
    {
        $result = '';
        $this->each(function (Element $node) use (&$result) {
            $result .= $node->ownerDocument->saveXML($node);
        });
        return $result;
    }

    /**
     * Create clone
     */
    public function __clone()
    {
        $nodes = [];
        foreach ($this as $node) {
            $nodes[] = clone $node;
        }
        $this->setNodes($nodes);
    }
}
