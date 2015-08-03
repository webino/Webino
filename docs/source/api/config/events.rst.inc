Listener
--------

- namespace: ``WebinoAppLib\Feature``

*Application listener config feature.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Listener;

    new Config([

        new Listener(MyExampleListener::class), // <--

    ]);


CoreListener
------------

- namespace: ``WebinoAppLib\Feature``

*Application core listener config feature.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreListener;

    new CoreConfig([

        new CoreListener(MyExampleCoreListener::class), // <--

    ]);

