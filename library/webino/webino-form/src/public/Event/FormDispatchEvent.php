<?php

namespace Webino;

/**
 * Class FormDispatchEvent
 * @package webino-form
 */
class FormDispatchEvent extends HttpDispatchEvent
{
    /**
     * @var Form
     */
    private $form;

    /**
     * @return Form|null
     */
    function getForm(): ?Form
    {
        return $this->form;
    }

    /**
     * @param Form $form
     */
    function setForm(Form $form): void
    {
        $this->form = $form;
    }

    /**
     * Removes form
     */
    function unsetForm(): void
    {
        $this->form = null;
    }
}
