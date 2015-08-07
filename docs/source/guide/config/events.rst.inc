Listener
--------

*Configuring listeners.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Listener;

    new Config([

        // invokable
        new Listener(MyExampleListener::class),

        // factory
        new Listener(MyExampleListener::class, MyExampleListenerFactory::class),

    ]);


- see: :ref:`architecture-events-event-listeners`


CoreListener
------------

*Configuring core listeners.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreListener;

    new CoreConfig([

        // invokable
        new CoreListener(MyExampleCoreListener::class),

        // factory
        new CoreListener(MyExampleCoreListener::class, MyExampleCoreListenerFactory::class),

    ]);


- see: :ref:`architecture-events-core-listeners`
