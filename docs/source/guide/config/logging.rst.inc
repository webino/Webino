Log
---

*Configuring logger.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\Log;

    new CoreConfig([

        new Log,

    ]);


- see: :ref:`api-logging-app-log`


FirePhpLog
----------

*Configuring FirePHP logger.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;

    new CoreConfig([

        new AppFeature\Log,
        new AppFeature\FirePhpLog,

    ]);


- see: :ref:`api-logging-app-log`
