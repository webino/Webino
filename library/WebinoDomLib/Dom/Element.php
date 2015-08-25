<?php

namespace WebinoDomLib\Dom;

use WebinoHtmlLib\EscaperAwareTrait;

/**
 * Class Element
 */
class Element extends \DOMElement implements NodeInterface
{
    use EscaperAwareTrait;
    use LocatorAwareTrait;

    /**
     * Return an element collection
     *
     * @param string|array $locator
     * @return NodeList
     */
    public function locate($locator)
    {
        $nodeList = $this->getLocator()->query($this, $locator);
        return new NodeList($nodeList);
    }

    /**
     * @param string $value Node value.
     * @return self
     */
    public function setValue($value)
    {
        $this->nodeValue = $this->getEscaper()->escapeHtml($value);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return self
     */
    public function setAttribute($name, $value)
    {
        parent::setAttribute($name, htmlspecialchars($value, ENT_QUOTES));
        return $this;
    }

    /**
     * @param string $html Valid XHTML code.
     * @return self
     */
    public function setHtml($html)
    {
        $this->nodeValue = '';
        $frag = $this->ownerDocument->createDocumentFragment();
        $frag->appendXml($html);
        $this->appendChild($frag);
        return $this;
    }

    /**
     * Returns the node body html
     *
     * @return string
     */
    public function getInnerHtml()
    {
        $html = '';
        foreach ($this->childNodes as $child) {
            $childHtml = $child->ownerDocument->saveXML($child);
            empty($childHtml) or $html .= $childHtml;
        }
        return $html;
    }

    /**
     * Returns the node html
     *
     * @return string
     */
    public function getOuterHtml()
    {
        return trim($this->ownerDocument->saveXML($this));
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        $nodeValue = trim($this->nodeValue);
        if (!empty($nodeValue) || is_numeric($nodeValue)) {
            return false;
        }

        // node value is empty,
        // check for child other than text
        foreach ($this->childNodes as $childNode) {
            if (!($childNode instanceof \DOMText)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return self
     */
    public function remove()
    {
        $this->parentNode->removeChild($this);
        return $this;
    }
}
