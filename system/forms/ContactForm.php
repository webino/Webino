<?php

namespace Webino;

/**
 * Class ContactForm
 */
class ContactForm
{
    /**
     * @return Form
     */
    function createForm(): Form
    {
        return new PostForm([

            (new FormInputText('name'))
                ->require(),

            (new FormInputEmail('email'))
                ->require(),

            (new FormInputTextarea('text'))
                ->require(),

            new FormButtonSubmit('contact_form'),
        ]);
    }

    function dispatch(FormDispatchEvent $event)
    {
        $form = $event->getForm();

        $form->setData(['name' => 'Ferko']);
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
