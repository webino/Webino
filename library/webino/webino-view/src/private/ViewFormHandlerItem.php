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
    public function getForm(): ?Form
    {
        return $this->form;
    }

    /**
     * @param Form|null $form
     */
    public function setForm(?Form $form): void
    {
        $this->form = $form;
    }
}
