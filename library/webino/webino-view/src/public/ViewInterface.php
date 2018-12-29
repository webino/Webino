<?php

namespace Webino;

/**
 * Interface ViewInterface
 * @package webino-view
 */
interface ViewInterface
{
    /**
     * @param ViewEvent $event
     */
    function view(ViewEvent $event): void;
}
