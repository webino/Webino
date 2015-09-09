.. _config-mail:

Mailer
------

Configuring custom mailer.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;

    new CoreConfig([
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

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;

    new CoreConfig([
        // TODO...
        new Mail(),
    ]);


.. seealso::
   :ref:`api-mail` ●
   `Mail Example <http://demo.webino.org/mail-message>`_
