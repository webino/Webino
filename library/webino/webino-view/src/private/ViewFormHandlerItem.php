<?php

namespace Webino;

/**
 * Class ViewFormHandlerItem
 * @package webino-view
 */
class ViewFormHandlerItem extends ViewHandlerItem
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
     * @param Form|null $form
     */
    function setForm(?Form $form): void
    {
        $this->form = $form;
    }
}
