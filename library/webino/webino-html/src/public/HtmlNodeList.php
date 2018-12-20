<?php

namespace Webino;

/**
 * Class HtmlNodeList
 * @package webino-html
 */
class HtmlNodeList implements \IteratorAggregate
{
    /**
     * @var \DOMNodeList
     */
    private $domNodeList;

    /**
     * @param \DOMNodeList $domNodeList
     */
    function __construct(\DOMNodeList $domNodeList)
    {
        $this->domNodeList = $domNodeList;
    }

    /**
     * Returns node list length
     *
     * @return int
     */
    function getLength(): int
    {
        return $this->domNodeList->length;
    }

    /**
     * @return string
     */
    function getInnerHtml(): string
    {
        $html = '';
        foreach ($this as $htmlNode) {
            $html.= $htmlNode->getInnerHtml();
        }
        return trim($html);
    }

    /**
     * @return string
     */
    function getOuterHtml(): string
    {
        $html = '';
        foreach ($this as $htmlNode) {
            $html.= $htmlNode->getOuterHtml();
        }
        return trim($html);
    }

    /**
     * @param callable $callback
     */
    function each(callable $callback)
    {
        foreach ($this as $htmlNode) {
            $callback($htmlNode);
        }
    }

    /**
     * @return HtmlNode[]|iterable
     */
    function getIterator(): iterable
    {
        foreach ($this->domNodeList ?? [] as $domNode) {
            yield new HtmlNode($domNode);
        }
    }
}
