Logger
------

Configuring custom logger.

.. code-block:: php

    use WebinoConfigLib\Feature\Log;
    use WebinoConfigLib\Feature\Logger;
    use WebinoConfigLib\Feature\FirePhpLog;

    Webino::config([
        new Logger('myLogger', [
            new Log,
            // etc.
        ]),
    ]);


.. seealso::
   :ref:`api-logging-app-get-logger` ●
   `Custom Logger Example <http://demo.webino.org/logger-custom>`__ ●
   `Custom Logger Aware Example <http://demo.webino.org/logger-aware-custom>`__


ChromePhpLog
------------

Configuring app ChromePHP logger writer.

.. code-block:: php

    use WebinoConfigLib\Feature\ChromePhpLog;

    Webino::config([
        new ChromePhpLog,
    ]);


.. seealso::
   :ref:`api-logging-app-log` ●
   `Chrome Logger Example <http://demo.webino.org/logger-ChromePHP>`__


FirePhpLog
----------

Configuring app FirePHP logger writer.

.. code-block:: php

    use WebinoConfigLib\Feature\FirePhpLog;

    Webino::config([
        new FirePhpLog,
    ]);


.. seealso::
   :ref:`api-logging-app-log` ●
   `Firefox Logger Example <http://demo.webino.org/logger-FirePHP>`__
