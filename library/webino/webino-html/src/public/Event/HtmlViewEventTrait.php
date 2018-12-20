<?php

namespace Webino;

/**
 * Trait HtmlViewEventTrait
 * @package webino-html
 */
trait HtmlViewEventTrait
{
    /**
     * @return HtmlNodeInterface
     */
    function getNode(): HtmlNodeInterface
    {
        return $this['node'];
    }

    /**
     * @param HtmlNodeInterface $node
     */
    function setNode(HtmlNodeInterface $node): void
    {
        $this['node'] = $node;
    }
}
