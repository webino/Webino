<?php

namespace Webino;

/**
 * Class HtmlNode
 * @package webino-html
 */
class HtmlNode implements HtmlNodeInterface, \ArrayAccess
{
    /**
     * @var \DOMNode
     */
    private $domNode;

    /**
     * @param \DOMNode $domNode
     */
    function __construct(\DOMNode $domNode)
    {
        $this->domNode = $domNode;
    }

    /**
     * Returns node name
     *
     * @return string
     */
    function getName(): string
    {
        return $this->domNode->nodeName;
    }

    /**
     * Rename node
     *
     * @param string $newName New node name
     */
    function rename(string $newName): void
    {
        $newNode = $this->domNode->ownerDocument->createElement($newName);
        foreach ($this->domNode->attributes as $attribute) {
            $newNode->setAttribute($attribute->name, $attribute->value);
        }
        foreach ($this->domNode->childNodes as $childNode) {
            $newNode->appendChild($childNode);
        }
        $this->domNode->parentNode->replaceChild($newNode, $this->domNode);
        $this->domNode = $newNode;
    }

    /**
     * Remove node from document
     */
    function remove(): void
    {
        $this->domNode->parentNode->removeChild($this->domNode);
    }

    /**
     * Set node text content
     *
     * @param string|null $newText
     */
    function setText(?string $newText): void
    {
        $this->domNode->textContent = (string) $newText;
    }

    /**
     * @return string
     */
    function getInnerHtml(): string
    {
        if (!$this->domNode->childNodes) {
            return '';
        }
        $html = '';
        foreach ($this->domNode->childNodes as $child) {
            $childHtml = $child->ownerDocument->saveXML($child);
            empty($childHtml) or $html .= $childHtml;
        }
        return trim($html);
    }

    /**
     * @return string
     */
    function getOuterHtml(): string
    {
        return trim($this->domNode->ownerDocument->saveHTML($this->domNode));
    }

    /**
     * Replace node with plain text
     *
     * @param string $newText
     */
    function replaceWithText(string $newText): void
    {
        $newNode = $this->domNode->ownerDocument->createTextNode($newText);
        $this->domNode = $this->domNode->parentNode->replaceChild($newNode, $this->domNode);
    }

    /**
     * Replace node with HTML
     *
     * @param string $newHtml
     */
    function replaceWithHtml(string $newHtml): void
    {
        $dom = new HtmlDocumentPart($newHtml);
        $domNode = $dom->getDocumentNode()->domNode;

        foreach ($domNode->childNodes as $childDomNode) {
            $newNode = $this->domNode->ownerDocument->importNode($childDomNode, true);
            $this->domNode->parentNode->insertBefore($newNode, $this->domNode);
        }

        $this->domNode->parentNode->removeChild($this->domNode);
        empty($newNode) or $this->domNode = $newNode;
    }

    /**
     * Replace node with new part
     *
     * @param HtmlPartInterface $htmlPart
     */
    function replaceWithPart(HtmlPartInterface $htmlPart): void
    {
        $htmlPart->renderHtmlNode($this);
    }

    /**
     * Add new node with name
     *
     * @param string $nodeName
     * @return HtmlNode
     */
    function addNode(string $nodeName): HtmlNode
    {
        $domNode = $this->domNode->ownerDocument->createElement($nodeName);
        $this->domNode->appendChild($domNode);
        return new self($domNode);
    }

    /**
     * Returns true when node attribute exists
     *
     * @param string $name
     * @return bool
     */
    function offsetExists($name)
    {
        return (bool) $this->domNode->attributes->getNamedItem((string) $name);
    }

    /**
     * Returns node attribute value
     *
     * @param string $name
     * @return null|string
     */
    function offsetGet($name): ?string
    {
        if (!$this->offsetExists($name)) {
            return null;
        }
        return $this->domNode->attributes->getNamedItem((string) $name)->nodeValue;
    }

    /**
     * Set node attribute
     *
     * @param string $name
     * @param string $value
     */
    function offsetSet($name, $value): void
    {
        $name = (string) $name;
        $value = (string) $value;

        if (strlen($value)) {
            if ($this->domNode instanceof \DOMElement) {
                $this->domNode->setAttribute($name, $value);
            }
        } else {
            $this->offsetUnset($name);
        }
    }

    /**
     * Remove node attribute
     *
     * @param string $name
     */
    function offsetUnset($name): void
    {
        if ($this->domNode instanceof \DOMElement) {
            $this->domNode->removeAttribute((string) $name);
        }
    }
}
