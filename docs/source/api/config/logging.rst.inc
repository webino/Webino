Log
---

- namespace: ``WebinoAppLib\Feature``

*Logging config feature.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\Log;

    new CoreConfig([

        new Log, // <--

    ]);


*Logging a message class.*

.. code-block:: php

    $app->log(MyDebugMessage::class);


FirePhpLog
----------

- namespace: ``WebinoAppLib\Feature``

*FirePHP logging config feature.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;

    new CoreConfig([

        new AppFeature\Log,
        new AppFeature\FirePhpLog, // <--

    ]);

