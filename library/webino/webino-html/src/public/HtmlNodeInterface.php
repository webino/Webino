<?php

namespace Webino;

/**
 * Interface HtmlNodeInterface
 * @package webino-html
 */
interface HtmlNodeInterface
{
    /**
     * Returns node name
     *
     * @return string
     */
    function getName(): string;

    /**
     * Rename node
     *
     * @param string $newName New node name
     */
    function rename(string $newName): void;

    /**
     * Remove node from document
     */
    function remove(): void;

    /**
     * Set node text content
     *
     * @param string|null $newText
     */
    function setText(?string $newText): void;

    /**
     * Replace node with plain text
     *
     * @param string $newText
     */
    function replaceWithText(string $newText): void;

    /**
     * Replace node with HTML
     *
     * @param string $newHtml
     */
    function replaceWithHtml(string $newHtml): void;

    /**
     * Replace node with new part
     *
     * @param HtmlPartInterface $htmlPart
     */
    function replaceWithPart(HtmlPartInterface $htmlPart): void;

    /**
     * Add new node with name
     *
     * @param string $nodeName
     * @return HtmlNode
     */
    function addNode(string $nodeName): HtmlNode;
}
