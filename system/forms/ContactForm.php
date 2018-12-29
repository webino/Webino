<?php

namespace Webino;

/**
 * Class ContactForm
 */
class ContactForm
{
    /**
     * Create contact form
     */
    function createForm()
    {
        yield PostForm => [
            FormStyleBootstrap,

            'name' => [
                FormInputText,
                FormInputLabel => 't[name]',
                FilterStringTrim,
                ValidateRequired,
            ],

            'email' => [
                FormInputEmail,
                FormInputLabel => 't[email]',
                FilterStringTrim,
                ValidateRequired,
            ],

            'text' => [
                FormInputTextarea,
                FormInputLabel => 't[text]',
                FilterStringTrim,
                ValidateRequired,
            ],

            'contact_form' => [
                FormButtonSubmit => 't[submit]',
            ],
        ];
    }

    function dispatch(FormDispatchEvent $event)
    {
        $form = $event->getForm();

        //$form->setData(['name' => 'Ferko']);
    }

    /**
     * @param FormSubmitEvent $event
     * @return mixed
     */
    function submit(FormSubmitEvent $event)
    {
        $form = $event->getForm();

        if ($form->isValid()) {
            $event->unsetForm();
            $event['formMessage'] = 'Hello Test';
        } else {
            $event['formError'] = 'ERROR';
        }
    }

    function view(ViewFormEvent $event)
    {

        $form = $event->getForm();
        $node = $event->getNode();

        if (isset($event['formError'])) {
            $p = $node->addNode('p');
            $p->setText($event['formError']);
            return true;
        }

        if (isset($event['formMessage'])) {
            $node = $event->getNode();
            $node->replaceWithHtml('<p/>');
            $node->setText($event['formMessage']);
            return false;
        }
    }
}
