Log
---

Configuring logger.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;

    new CoreConfig([
        new Log,
    ]);


- see: :ref:`api-logging-app-log`


FirePhpLog
----------

Configuring FirePHP logger.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\FirePhpLog;

    new CoreConfig([
        new FirePhpLog,
    ]);


- see: :ref:`api-logging-app-log`
