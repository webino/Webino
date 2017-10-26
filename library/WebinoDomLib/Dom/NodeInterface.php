<?php

namespace WebinoDomLib\Dom;

/**
 * Interface NodeInterface
 */
interface NodeInterface
{
    /**
     * @param string $value Node value.
     * @return $this
     */
    public function setValue($value);

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setAttribute($name, $value);

    /**
     * @param string $html Valid XHTML code.
     * @return $this
     */
    public function setHtml($html);

    /**
     * Returns the node body html
     *
     * @return string
     */
    public function getInnerHtml();

    /**
     * Returns the node html
     *
     * @return string
     */
    public function getOuterHtml();

    /**
     * @return bool
     */
    public function isEmpty();

    /**
     * @param string $nodeName New node name.
     * @return $this
     */
    public function rename($nodeName);

    /**
     * @param string $html.
     * @return $this
     */
    public function replace($html);

    /**
     * @return $this
     */
    public function remove();
}
