<?php

namespace Webino;

/**
 * Trait HttpRequestEventTrait
 * @package webino-http
 */
trait HttpRequestEventTrait
{
    /**
     * @return HttpRequestInterface
     */
    function getRequest(): HttpRequestInterface
    {
        return $this['request'];
    }

    /**
     * @param HttpRequestInterface $request
     */
    function setRequest(HttpRequestInterface $request): void
    {
        $this['request'] = $request;
    }
}
