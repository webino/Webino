<?php

namespace Webino;

/**
 * Interface RouterInterface
 * @package webino-router
 */
interface RouterInterface
{
    /**
     * Add route
     *
     * @param RouteInterface $route
     */
    function addRoute(RouteInterface $route): void;

    /**
     * Returns route hypertext reference
     *
     * @param string $route
     * @param array $params
     * @return string|null
     */
    function url(string $route, $params = []): ?string;

    /**
     * Dispatch matched route
     *
     * @param HttpResponseEvent $event
     * @param callable|null $callback
     * @throws NotFoundStatusException
     * @return mixed
     */
    function dispatch(HttpResponseEvent $event, callable $callback = null);
}
