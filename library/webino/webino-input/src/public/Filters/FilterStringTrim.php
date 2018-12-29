<?php

namespace Webino;

/**
 * Class FilterStringTrim
 * @package webino-input
 */
class FilterStringTrim extends AbstractFilter
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
