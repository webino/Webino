<?php

namespace Webino;

/**
 * Trait HttpContextTrait
 * @package webino-http
 */
trait HttpContextTrait
{
    /**
     * @var iterable
     */
    private $params;

    /**
     * @return iterable
     */
    abstract protected function createParams(): iterable;

    /**
     * @return iterable
     */
    protected function getParams(): iterable
    {
        $this->params or $this->params = $this->createParams();
        return $this->params;
    }

    /**
     * @param string $offset
     * @return bool
     */
    function offsetExists($offset)
    {
        return array_key_exists((string) $offset, $this->getParams());
    }

    /**
     * @param string $offset
     * @return mixed
     */
    function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->getParams()[(string) $offset] : null;
    }

    /**
     * @param string $offset
     * @param mixed $value
     */
    function offsetSet($offset, $value)
    {
        // read-only
    }

    /**
     * @param string $offset
     */
    function offsetUnset($offset)
    {
        // read-only
    }
}
