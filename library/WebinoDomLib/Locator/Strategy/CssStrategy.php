<?php

namespace WebinoDomLib\Locator\Strategy;

//use WebinoView\Dom\Locator\TransformatorInterface;
use Zend\Dom\Document\Query as DomQuery;

/**
 * Class CssStrategy
 */
class CssStrategy
{
    /**
     * @param string $locator
     * @return string
     */
    public function locatorToXpath($locator)
    {
        if (0 === strpos($locator, '//')) {
            // return early for absolute
            return DomQuery::cssToXpath(substr($locator, 2));
        }
        // dot makes it relative
        return '.' . DomQuery::cssToXpath($locator);
    }
}
