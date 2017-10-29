Listener
--------

Configuring listeners.

.. code-block:: php

    use WebinoAppLib\Feature\Listener;

    Webino::config([
        // invokable
        new Listener(MyExampleListener::class),
        // factory
        new Listener(MyExampleListener::class, MyExampleListenerFactory::class),
    ]);


.. seealso::
   :ref:`architecture-events-event-listeners` ●
   `Bootstrap Bind Config Example <http://demo.webino.org/events-bind-app-bootstrap-config>`__


CoreListener
------------

Configuring core listeners.

.. code-block:: php

    use WebinoAppLib\Feature\CoreListener;

    Webino::config([
        // invokable
        new CoreListener(MyExampleCoreListener::class),
        // factory
        new CoreListener(MyExampleCoreListener::class, MyExampleCoreListenerFactory::class),
    ]);


.. seealso::
   :ref:`architecture-events-core-listeners` ●
   `Bootstrap Bind Core Config Example <http://demo.webino.org/events-bind-app-bootstrap-core-config>`__
