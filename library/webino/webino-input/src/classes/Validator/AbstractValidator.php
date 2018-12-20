<?php

namespace Webino\Validator;

/**
 * Class AbstractValidator
 * @package webino-input
 */
abstract class AbstractValidator
{
    /**
     * Returns true when provided value is valid
     *
     * @param mixed $value Validated value
     * @return bool True on valid
     */
    abstract function validate($value): bool;
}
