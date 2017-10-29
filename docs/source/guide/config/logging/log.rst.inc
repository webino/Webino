Log
---

Configuring app file logger writer, ``data/log/app.log`` by default.

.. code-block:: php

    use WebinoConfigLib\Feature\Log;

    Webino::config([
        // Enabling default logging
        new Log,
        // Overriding default logging file
        new Log('my/folder/app.log'),
    ]);


.. seealso::
   :ref:`api-logging` ●
   `Log Message Example <http://demo.webino.org/logger-message>`__ ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`__ ●
   `PSR-3 Logger Example <http://demo.webino.org/logger-PSR-3>`__


Configuring file logger formatting.

.. code-block:: php

    use WebinoConfigLib\Feature\Log;

    Webino::config([
        // Simple format
        (new Log)->setSimpleFormat('%timestamp% %priorityName% (%priority%): %message% %extra%'),

        // XML format
        (new Log('my/folder/app.log.xml'))->setXmlFormat(),
    ]);


.. seealso::
   :ref:`api-logging-app-log` ●
   `Log XML Format Example <http://demo.webino.org/logger-XML>`__

