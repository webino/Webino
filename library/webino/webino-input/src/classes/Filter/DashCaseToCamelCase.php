<?php

namespace Webino\Filter;

/**
 * Class DashCaseToCamelCase
 * @package webino-input
 */
class DashCaseToCamelCase extends AbstractFilter
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
