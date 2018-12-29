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
     * @param FormInputLabel $label
     */
    abstract function setLabel(FormInputLabel $label): void;

    /**
     * Set input options
     *
     * @param iterable $options
     */
    protected function setOptions(iterable $options): void
    {
        foreach ($options as $option) {
            if (is_object($option)) {
                switch (true) {
                    case $option instanceof FormInputLabel:
                        $this->setLabel($option);
                        break;
                    case $option instanceof ValidatorInterface:
                        $this->getValidators()->add($option);
                        break;
                }
            }
        }
    }

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
}
