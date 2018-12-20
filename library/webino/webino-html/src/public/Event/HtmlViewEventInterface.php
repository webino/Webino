<?php

namespace Webino;

/**
 * Interface HtmlViewEventInterface
 * @package webino-html
 */
interface HtmlViewEventInterface
{
    /**
     * Returns HTML view node
     *
     * @return HtmlNodeInterface
     */
    function getNode(): HtmlNodeInterface;

    /**
     * Set HTML view node
     *
     * @param HtmlNodeInterface $node
     */
    function setNode(HtmlNodeInterface $node): void;
}
