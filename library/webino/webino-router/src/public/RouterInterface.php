<?php

namespace Webino;

/**
 * Interface RouterInterface
 * @package webino-router
 */
interface RouterInterface
{
    /**
     * Route path to class
     *
     * @param string $routePath
     * @param string $routeClass
     */
    function route(string $routePath, string $routeClass): void;
}
