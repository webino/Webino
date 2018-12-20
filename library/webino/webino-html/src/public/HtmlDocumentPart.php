<?php

namespace Webino;

/**
 * Class HtmlDocumentPart
 * @package webino-html
 */
class HtmlDocumentPart extends AbstractHtmlDocument implements HtmlPartInterface
{
    /**
     * HTML DOM load options
     */
    protected const LOAD_OPTIONS = parent::LOAD_OPTIONS | LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;

    /**
     * @param string $html
     */
    function __construct(string $html)
    {
        parent::__construct("<root>$html</root>");
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $htmlNode->replaceWithHtml($this);
        return $htmlNode;
    }
}
