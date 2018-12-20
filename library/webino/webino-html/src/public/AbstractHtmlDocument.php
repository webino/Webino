<?php

namespace Webino;

use DOMDocument;
use DOMXPath;

/**
 * Class AbstractHtmlDocument
 * @package webino-html
 */
abstract class AbstractHtmlDocument
{
    /**
     * HTML DOM load options
     */
    protected const LOAD_OPTIONS = LIBXML_COMPACT | LIBXML_PARSEHUGE | LIBXML_NOERROR | LIBXML_NOWARNING | LIBXML_NONET | LIBXML_NOENT | LIBXML_NOCDATA | LIBXML_NOBLANKS;

    /**
     * HTML fixes
     */
    protected const HTML_FIX = [];

    /**
     * @var DOMXpath
     */
    protected $xpath;

    /**
     * @var string
     */
    protected $html;

    /**
     * @param string $html
     */
    function __construct(string $html)
    {
        $this->html = $html;
    }

    /**
     * @return string
     */
    function __toString(): string
    {
        return strtr($this->getXpath()->document->saveHTML(), array_flip($this::HTML_FIX));
    }

    /**
     * Returns document node
     *
     * @return HtmlNode
     */
    function getDocumentNode(): HtmlNode
    {
        $this->xpath or $this->createDocument();
        return new HtmlNode($this->xpath->document->documentElement);
    }

    /**
     * @param string $xpath
     * @return HtmlNodeList
     */
    function query(string $xpath): HtmlNodeList
    {
        $nodeList = $this->getXpath()->query($xpath);
        return new HtmlNodeList($nodeList);
    }

    /**
     * @return DOMXPath
     */
    protected function getXpath(): DOMXpath
    {
        $this->xpath or $this->createDocument();
        return $this->xpath;
    }

    /**
     * Creates DOMDocument with XPath support from provided HTML markup
     */
    protected function createDocument()
    {
        $dom = new DOMDocument;
        $html = mb_convert_encoding($this->html, 'HTML-ENTITIES', 'UTF-8');
        empty($this::HTML_FIX) or $html = strtr($html, $this::HTML_FIX);
        $dom->loadHTML($html, $this::LOAD_OPTIONS);
        $this->html = '';
        $this->xpath = new DOMXPath($dom);
    }
}
