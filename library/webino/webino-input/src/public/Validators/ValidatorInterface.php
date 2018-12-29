<?php

namespace Webino;

/**
 * Interface ValidatorInterface
 * @package webino-input
 */
interface ValidatorInterface
{
    /**
     * Returns true when provided value is valid
     *
     * @param mixed $value Validated value
     * @return bool True on valid
     */
    function validate($value): bool;
}
