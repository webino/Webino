<?php

namespace Webino;

/**
 * Trait FormFieldTrait
 * @package webino-form
 */
trait FormFieldTrait
{
    /**
     * Input label
     *
     * @var FormInputLabel
     */
    protected $label;

    /**
     * Return form input label
     *
     * @return FormInputLabel
     */
    function getLabel(): FormInputLabel
    {
        return $this->label;
    }

    /**
     * @param FormInputLabel $label
     */
    function setLabel(FormInputLabel $label): void
    {
        $this->label = $label;
    }
}
