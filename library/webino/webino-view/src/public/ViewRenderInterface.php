<?php

namespace Webino;

/**
 * Interface ViewRenderInterface
 * @package webino-view
 */
interface ViewRenderInterface
{
    /**
     * Render a HTML node
     *
     * @param HtmlRenderEvent $event
     */
    function render(HtmlRenderEvent $event): void;
}
