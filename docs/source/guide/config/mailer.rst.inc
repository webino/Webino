.. _config-mail:

Mailer
------

Configuring custom mailer.

.. code-block:: php

    use WebinoConfigLib\Feature\Log;

    Webino::config([
        // TODO...
        new DefaultMailer(FileMailer::class),
        new FileMailer(),
        new SmtpMailer(),
        new SendmailMailer(),
        new InMemoryMailer(),
    ]);



Mail
----

TODO...

.. code-block:: php

    use WebinoConfigLib\Feature\Log;

    Webino::config([
        // TODO...
        new Mail(),
    ]);


.. seealso::
   :ref:`api-mailer` ●
   `Mail Example <http://demo.webino.org/mail-message>`__
