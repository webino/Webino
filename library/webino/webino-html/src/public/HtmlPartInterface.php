<?php

namespace Webino;

/**
 * Interface HtmlPartInterface
 * @package webino-html
 */
interface HtmlPartInterface
{
    /**
     * Perform replacement of provided html node
     *
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface;
}
