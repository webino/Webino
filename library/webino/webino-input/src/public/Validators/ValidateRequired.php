<?php

namespace Webino;

/**
 * Class ValidateRequired
 * @package webino-input
 */
class ValidateRequired extends AbstractValidator
{
    /**
     * Returns true when value not empty
     *
     * @param mixed $value
     * @return bool
     */
    function validate($value): bool
    {
        return (bool) strlen((string) $value);
    }
}
