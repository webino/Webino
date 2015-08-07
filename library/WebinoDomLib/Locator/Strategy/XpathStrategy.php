<?php

namespace WebinoDomLib\Locator\Strategy;

//use WebinoDraw\Dom\Locator\TransformatorInterface;

/**
 * Class XpathStrategy
 */
class XpathStrategy
{
    /**
     * @param string $locator
     * @return string
     */
    public function locatorToXpath($locator)
    {
        return $locator;
    }
}
