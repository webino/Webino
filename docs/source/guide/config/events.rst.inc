Listener
--------

Configuring listeners.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Listener;

    new Config([
        // invokable
        new Listener(MyExampleListener::class),
        // factory
        new Listener(MyExampleListener::class, MyExampleListenerFactory::class),
    ]);


.. seealso::
   :ref:`architecture-events-event-listeners` |
   `Bootstrap Bind Config Example <http://demo.webino.org/events-bind-app-bootstrap-config>`_


CoreListener
------------

Configuring core listeners.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreListener;

    new CoreConfig([
        // invokable
        new CoreListener(MyExampleCoreListener::class),
        // factory
        new CoreListener(MyExampleCoreListener::class, MyExampleCoreListenerFactory::class),
    ]);


.. seealso::
   :ref:`architecture-events-core-listeners` |
   `Bootstrap Bind Core Config Example <http://demo.webino.org/events-bind-app-bootstrap-core-config>`_
