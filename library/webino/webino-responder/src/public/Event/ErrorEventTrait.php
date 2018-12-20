<?php

namespace Webino;

/**
 * Trait ErrorEventTrait
 * @package webino-responder
 */
trait ErrorEventTrait
{
    /**
     * @return \Throwable|null
     */
    function getException(): ?\Throwable
    {
        return $this['exception'] ?? null;
    }

    /**
     * @param \Throwable|null $exception
     * @return $this
     */
    function setException(\Throwable $exception = null)
    {
        $this['exception'] = $exception;
        return $this;
    }
}
