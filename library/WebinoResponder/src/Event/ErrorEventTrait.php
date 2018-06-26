<?php

namespace Webino\Event;

/**
 * Trait ErrorEventTrait
 */
trait ErrorEventTrait
{
    /**
     * @return \Throwable
     */
    public function getException() : \Throwable
    {
        return $this['exception'];
    }

    /**
     * @param \Throwable $exception
     * @return $this
     */
    public function setException(\Throwable $exception)
    {
        $this['exception'] = $exception;
        return $this;
    }
}
