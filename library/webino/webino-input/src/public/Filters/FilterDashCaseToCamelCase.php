<?php

namespace Webino;

/**
 * Class FilterDashCaseToCamelCase
 * @package webino-input
 */
class FilterDashCaseToCamelCase extends AbstractFilter
{
    /**
     * @param mixed $value
     * @return string
     */
    function filter($value)
    {
        $parts = explode('-', (string) $value);
        foreach ($parts as &$part) {
            $part = ucfirst($part);
        }
        return join('', $parts);
    }
}
