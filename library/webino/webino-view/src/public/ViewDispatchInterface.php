<?php

namespace Webino;

/**
 * Interface ViewDispatchInterface
 * @package webino-view
 */
interface ViewDispatchInterface
{
    /**
     * Dispatch a view component
     *
     * @param HttpDispatchEvent $event
     */
    function dispatch(HttpDispatchEvent $event): void;
}
