<?php

namespace Webino\Filter;

/**
 * Interface FilterInterface
 * @package webino-input
 */
interface FilterInterface
{
    /**
     * Returns filtered value
     *
     * @param mixed $value
     * @return mixed
     */
    function filter($value);
}
