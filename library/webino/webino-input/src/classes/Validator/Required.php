<?php

namespace Webino\Validator;

/**
 * Class Required
 * @package webino-input
 */
class Required extends AbstractValidator
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
