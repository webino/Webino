<?php

namespace Webino;

/**
 * Class ViewFormEvent
 * @package webino-view
 */
class ViewFormEvent extends ViewEvent
{
    /**
     * Returns view form
     *
     * @return Form|null
     */
    function getForm(): ?Form
    {
        return $this['form'] ?? null;
    }

    /**
     * Set view form
     *
     * @param Form|null $form
     */
    function setForm(?Form $form): void
    {
        $this['form'] = $form;
    }
}
