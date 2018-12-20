<?php

namespace Webino\Filter;

/**
 * Class StringTrim
 * @package webino-input
 */
class StringTrim extends AbstractFilter
{
    /**
     * Trim character list
     *
     * @var string
     */
    private $charList;

    /**
     * Set character list to trim
     *
     * @param string $charList
     */
    function setCharList(string $charList): void
    {
        $this->charList = $charList;
    }

    /**
     * @param mixed $value
     * @return string
     */
    function filter($value)
    {
        return trim((string) $value, $this->charList);
    }
}
