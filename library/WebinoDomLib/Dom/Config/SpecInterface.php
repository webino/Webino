<?php

namespace WebinoDomLib\Dom\Config;

/**
 * Interface SpecInterface
 */
interface SpecInterface
{
    /**
     * @param string $locator
     * @return self
     */
    public function setLocator($locator);

    /**
     * @param mixed $priority
     * @return self
     */
    public function setPriority($priority);

    /**
     * @param string $value Node value.
     * @return self
     */
    public function setValue($value);

    /**
     * @param string $html Valid XHTML code.
     * @return self
     */
    public function setHtml($html);

    /**
     * @param string $name Attribute name.
     * @param string $value Attribute value.
     * @return self
     */
    public function setAttribute($name, $value);

    /**
     * @param string $newName New node name.
     * @return self
     */
    public function setRename($newName);
}
