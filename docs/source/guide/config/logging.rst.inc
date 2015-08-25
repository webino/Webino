.. _config-logging-log:

Log
---

Configuring app file logger writer, ``data/log/app.log`` by default.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;

    new CoreConfig([
        // Enabling default logging
        new Log,
        // Overriding default logging file
        new Log('my/folder/app.log'),
    ]);


.. seealso::
   :ref:`api-logging` ●
   `Log Message Example <http://demo.webino.org/logger-message>`_ ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`_ ●
   `PSR-3 Logger Example <http://demo.webino.org/logger-PSR-3>`_


Configuring file logger formatting.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;

    new CoreConfig([
        // Simple format
        (new Log)->setSimpleFormat('%timestamp% %priorityName% (%priority%): %message% %extra%'),

        // XML format
        (new Log('my/folder/app.log.xml'))->setXmlFormat(),
    ]);


.. seealso::
   :ref:`api-logging-app-log` ●
   `Log XML Format Example <http://demo.webino.org/logger-XML>`_


.. _config-logging-forking:

--------------
Forking Logger
--------------

Creating new logger writer instead of overriding the default.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;

    new CoreConfig([
        (new Log('my/folder/my-app.log'))->setName('my'),
    ]);


.. seealso::
   :ref:`config-logging-filters` ●
   `Logger Priority Filter Example <http://demo.webino.org/logger-filters-priority>`_ ●
   `Logger Regex Filter Example <http://demo.webino.org/logger-filters-regex>`_


.. _config-logging-logger:

Logger
------

Configuring custom logger.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\Log;
    use WebinoConfigLib\Feature\Logger;
    use WebinoConfigLib\Feature\FirePhpLog;

    new Config([
        new Logger('myLogger', [
            new Log,
            // etc.
        ]),
    ]);


.. seealso::
   :ref:`api-logging-app-get-logger` ●
   `Custom Logger Example <http://demo.webino.org/logger-custom>`_ ●
   `Custom Logger Aware Example <http://demo.webino.org/logger-aware-custom>`_


ChromePhpLog
------------

Configuring app ChromePHP logger writer.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\ChromePhpLog;

    new CoreConfig([
        new ChromePhpLog,
    ]);


.. seealso::
   :ref:`api-logging-app-log` ●
   `Chrome Logger Example <http://demo.webino.org/logger-ChromePHP>`_


FirePhpLog
----------

Configuring app FirePHP logger writer.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\FirePhpLog;

    new CoreConfig([
        new FirePhpLog,
    ]);


.. seealso::
   :ref:`api-logging-app-log` ●
   `Firefox Logger Example <http://demo.webino.org/logger-FirePHP>`_
