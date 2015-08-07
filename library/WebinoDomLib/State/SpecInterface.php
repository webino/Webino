<?php

namespace WebinoDomLib\State;

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
}
