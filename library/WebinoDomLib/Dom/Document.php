<?php

namespace WebinoDomLib\Dom;

use DOMXpath;

/**
 * Extended DOMDocument
 */
class Document extends \DOMDocument
{
    /**
     * @var DOMXpath
     */
    protected $xpath;

    /**
     * @param string $version
     * @param string $encoding
     */
    public function __construct($version = null, $encoding = null)
    {
        parent::__construct($version, $encoding);

        $this->registerNodeClass('DOMElement', Element::class);
//        $this->registerNodeClass('DOMText', 'WebinoView\Dom\Text');
//        $this->registerNodeClass('DOMAttr', 'WebinoView\Dom\Attr');
    }

    /**
     * @return DOMXpath
     */
    public function getXpath()
    {
        if (null == $this->xpath) {
            $this->setXpath(new DOMXPath($this));
        }
        return $this->xpath;
    }

    /**
     * @param DOMXpath $xpath
     * @return $this
     */
    public function setXpath(DOMXpath $xpath)
    {
        $this->xpath = $xpath;
        return $this;
    }

    /**
     * @return \DOMElement|NodeInterface
     */
    public function getDocumentElement()
    {
        return $this->documentElement;
    }
}
