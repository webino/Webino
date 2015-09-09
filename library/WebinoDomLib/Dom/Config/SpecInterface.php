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
}
