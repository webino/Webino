<?php

namespace Webino;

/**
 * Trait FormValueInputTrait
 * @package webino-form
 */
trait FormValueInputTrait
{
    /**
     * Input data
     *
     * @var string
     */
    private $data;

    /**
     * @var Validators
     */
    private $validators;

    /**
     * @return Validators
     */
    function getValidators(): Validators
    {
        $this->validators or $this->validators = new Validators;
        return $this->validators;
    }

    /**
     * Returns form input data
     *
     * @return string
     */
    function getData(): string
    {
        return (string) $this->data;
    }

    /**
     * Sets form input data
     *
     * @param string $data
     */
    function setData(string $data): void
    {
        $this->data = $data;
    }

    /**
     * Returns true when form is valid
     *
     * @return bool
     */
    function isValid(): bool
    {
        $data = $this->getData();

        return $this->getValidators()->validate($data);
    }

    /**
     * @param bool $require
     * @return $this
     */
    function require(bool $require = true)
    {
        if ($require) {
            $this->getValidators()->add(new Validator\Required);
        } else {
            $this->getValidators()->drop(Validator\Required::class);
        }
        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     *
     */
    function requireLength(int $min, int $max)
    {
        // TODO
    }
}
