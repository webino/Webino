<?php

namespace WebinoDomLib\Dom;

/**
 * Interface NodeLocatorInterface
 */
interface NodeLocatorInterface
{
    /**
     * Return an element collection
     *
     * @param string|array $locator
     * @return NodeList
     */
    public function locate($locator);
}
