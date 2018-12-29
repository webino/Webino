<?php

namespace Webino;

/**
 * Class AbstractFilter
 * @package webino-input
 */
abstract class AbstractFilter implements FilterInterface
{
    /**
     * Returns filtered value
     *
     * @param mixed $value
     * @return mixed
     */
    abstract function filter($value);
}
