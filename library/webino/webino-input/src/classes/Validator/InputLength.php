<?php

namespace Webino\Validator;

/**
 * Class InputLength
 * @package webino-input
 */
class InputLength extends AbstractValidator
{
    /**
     * Mimimum length
     *
     * @var int
     */
    private $min = 0;

    /**
     * Maximum length
     *
     * @var int
     */
    private $max;

    /**
     * Set minimum string length
     *
     * @param int $min
     */
    function setMin(int $min): void
    {
        $this->min = $min;
    }

    /**
     * Set maximum string length
     *
     * @param int $max
     */
    function setMax(int $max): void
    {
        $this->max = $max;
    }

    /**
     * Returns true when value string length is in required range
     *
     * @param mixed $value
     * @return bool
     */
    function validate($value): bool
    {
        $len = mb_strlen($value, 'utf-8');
        return $this->min <= $len && (!$this->max || $this->max >= $len);
    }
}
