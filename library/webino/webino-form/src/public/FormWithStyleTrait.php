<?php

namespace Webino;

/**
 * Trait FormWithStyleTrait
 * @package webino-form
 */
trait FormWithStyleTrait
{
    /**
     * @var FormStyleInterface
     */
    private $style;

    /**
     * @return FormStyleInterface
     */
    protected function getStyle(): FormStyleInterface
    {
        $this->style or $this->style = new FormStyleNone;
        return $this->style;
    }

    /**
     * @param FormStyleInterface $style
     */
    function setStyle(FormStyleInterface $style): void
    {
        $this->style = $style;
    }
}
