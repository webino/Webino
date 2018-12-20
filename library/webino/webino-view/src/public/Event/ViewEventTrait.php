<?php

namespace Webino;

/**
 * Trait ViewLayoutEvent
 * @package webino-view
 */
trait ViewEventTrait
{
    /**
     * @return HtmlDocument
     */
    function getDom(): HtmlDocument
    {
        return $this['dom'];
    }

    /**
     * @param HtmlDocument $dom
     */
    function setDom(HtmlDocument $dom): void
    {
        $this['dom'] = $dom;
    }
}
