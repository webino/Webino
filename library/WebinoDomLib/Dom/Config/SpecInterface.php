<?php

namespace WebinoDomLib\Dom\Config;

/**
 * Interface SpecInterface
 */
interface SpecInterface
{
    /**
     * @param string $locator
     * @return $this
     */
    public function setLocator($locator);

    /**
     * @param mixed $priority
     * @return $this
     */
    public function setPriority($priority);

    /**
     * @param string $value Node value.
     * @return $this
     */
    public function setValue($value);

    /**
     * @param string $html Valid XHTML code.
     * @return $this
     */
    public function setHtml($html);

    /**
     * @param string $name Attribute name.
     * @param string $value Attribute value.
     * @return $this
     */
    public function setAttribute($name, $value);

    /**
     * @param string $newName New node name.
     * @return $this
     */
    public function setRename($newName);
}
