Mailer Cookbook
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


.. _cookbook-mailer-messages:

Mailing Messages
----------------

TODO...

.. code-block:: php

    // simple message
    $app->mail()->send('recipient@example.com', 'The subject', 'The body');

    $app->mail()->send(['recipient-one@example.com', 'recipient-two@example.com'], 'The subject', 'The body');

    // message template
    $app->mail('my-mail')->send('recipient@example.com');

    // overriding template subject & body
    $app->mail('my-mail')->send('recipient@example.com', 'The subject', 'The body');

    // attachments
    $app->mail()
        ->setAttachments(['test.txt' => 'data/mail/test.txt', 'data/mail/other.txt'])
        ->send('recipient@example.com', 'The subject', 'The body');

.. seealso::
   :ref:`api-mailer` ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`_
