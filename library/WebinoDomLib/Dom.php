<?php

namespace WebinoDomLib;

use WebinoDomLib\Dom\LocatorAwareTrait;

/**
 * Class DomHtml
 *
 * @package WebinoDomLib
 */
class Dom
{
    use LocatorAwareTrait;

    /**
     * @var Dom\Document
     */
    private $doc;

    // TODO factory
    public function __construct($code)
    {
        // hack HTML5
        libxml_use_internal_errors(true);

        $this->doc = new Dom\Document;

        // TODO
        $this->doc->isXml = false;

        $this->doc->isXml ? $this->doc->loadXml($code)
               : $this->doc->loadHtml(mb_convert_encoding($code, 'HTML-ENTITIES', 'UTF-8'));
    }

    /**
     * Return an element collection
     *
     * @param string|array $locator
     * @return Dom\NodeList
     */
    public function locate($locator)
    {
        $nodeList = $this->getLocator()->query($this->doc->getDocumentElement(), $locator);
        return new Dom\NodeList($nodeList);
    }

    /**
     * @return string
     */
    public function save()
    {
        // TODO resolve ->doc->isXml()
        return $this->doc->isXml ? $this->doc->saveXml() : $this->doc->saveHtml();
    }
}
