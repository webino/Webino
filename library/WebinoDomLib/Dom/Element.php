<?php

namespace WebinoDomLib\Dom;

use WebinoDomLib\Dom;
use WebinoHtmlLib\EscaperAwareTrait;

/**
 * Class Element
 */
class Element extends \DOMElement implements
    NodeInterface,
    NodeLocatorInterface
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
     * @return $this
     */
    public function setValue($value)
    {
        $this->nodeValue = $this->getEscaper()->escapeHtml($value);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setAttribute($name, $value)
    {
        if (empty($value)) {
            $this->removeAttribute($name);
            return $this;
        }

        parent::setAttribute($name, htmlspecialchars($value, ENT_QUOTES));
        return $this;
    }

    /**
     * @param string $html Valid XHTML code.
     * @return $this
     */
    public function setHtml($html)
    {
        if (empty($html)) {
            return $this;
        }

        $this->nodeValue = '';
        $frag = $this->ownerDocument->createDocumentFragment();
        $frag->appendXml($html);

        // TODO refactor
        if ($frag->firstChild) {
            $this->appendChild($frag);
        } else {
            /** @var Element $node */
            foreach ((new Dom($html))->locate('body') as $node) {
                foreach ($node->childNodes as $child) {
                    $this->appendChild($this->ownerDocument->importNode($child, true));
                }
            }
        }

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
     * @param string $nodeName New node name.
     * @return self
     */
    public function rename($nodeName)
    {
        /** @var self $node */
        $node = $this->ownerDocument->createElement($nodeName);

        $html = $this->getInnerHtml();
        $html and $node->setHtml($html);

        foreach ($this->attributes as $attrib) {
            $node->setAttributeNode($attrib);
        }

        $this->parentNode->insertBefore($node, $this);
        $this->remove();

        return $node;
    }

    /**
     * @param string $html.
     * @return self
     */
    public function replace($html)
    {
        if (empty($html)) {
            $this->remove();
            return $this;
        }

        $frag = $this->ownerDocument->createDocumentFragment();
        $frag->appendXML($html);

        // TODO refactor
        if ($frag->firstChild) {
            $node = $this->parentNode->insertBefore($frag, $this);
        } else {
            $nodes = [];
            /** @var Element $node */
            foreach ((new Dom($html))->locate('body') as $subNode) {
                foreach ($subNode->childNodes as $child) {
                    // TODO add node to node list
                    $nodes[] = $this->parentNode->insertBefore($this->ownerDocument->importNode($child, true), $this);
                }
            }
            $node = new NodeList($nodes);
        }

        $this->remove();
        return $node;
    }

    /**
     * @return $this
     */
    public function remove()
    {
        $this->parentNode->removeChild($this);
        return $this;
    }
}
