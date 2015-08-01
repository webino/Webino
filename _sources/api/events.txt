.. rst-class:: monospace

Application Events API
======================

.. contents::
    :depth: 1
    :local:

Event Emitter Methods
---------------------

Application can emit events and bind listeners to them.

$app->bind()
^^^^^^^^^^^^

*Binding a listener to an event.*

.. code-block:: php

    // creating a closure listener
    $handler = function (AppEvent $event) {
        // do something...
    };

    // attaching a closure listener to a custom event
    $app->bind('myEvent', $handler);

    // attaching a closure listener to a dispatch event
    $app->bind(AppEvent::DISPATCH, $handler);

    // attaching an invokable class
    $app->bind(AppEvent::DISPATCH, MyListener::class);

    // specifying a priority
    $app->bind(AppEvent::DISPATCH, $handler, AppEvent::BEGIN);

    // attaching a listener aggregate
    $app->bind(MyListenerAggregate::class);


$app->unbind()
^^^^^^^^^^^^^^

*Unbinding a listener from an event.*

.. code-block:: php

    // for all events and priorities
    $app->unbind($handler);

    // for a specific event
    $app->unbind('someEvent', $handler);

    // for a specific priority too
    $app->unbind('someEvent', $handler, $priority);


$app->emit()
^^^^^^^^^^^^

*Emitting an event.*

.. code-block:: php

    // just emit an event
    $app->emit('myEvent');

    // event with custom arguments
    $app->emit('myEvent', [$argOne, $argTwo);

    // creating an event callback
    $callback = function ($result)
    {
        // do something...
    }

    // event with callback
    $app->emit('myEvent', $callback);

    // event with custom arguments and callback
    $app->emit('myEvent', [$argOne, $argTwo], $callback);

    // custom event object
    $app->emit(new MyEvent);


Application Core Events
-----------------------

Following events are emitted during an application core lifecycle.

AppEvent::CONFIGURE
^^^^^^^^^^^^^^^^^^^

*Configuring an application, merging modules configurations.*

This event is emitted in the middle of the two pass bootstrap event, allowing
you to merge an application configuration. Only core listeners can bind to this event.

.. code-block:: php

    $app->bind(AppEvent::CONFIGURE, MyListener::class);

AppEvent::BOOTSTRAP
^^^^^^^^^^^^^^^^^^^

*Initializing an application, all the services will be ready.*

After this two pass event all the services should be ready. The core listeners
binds to the first pass and a remaining can listen to the second pass bootstrap event.

.. code-block:: php

    $app->bind(AppEvent::BOOTSTRAP, MyListener::class);


AppEvent::DISPATCH
^^^^^^^^^^^^^^^^^^

*Handling the client request and sending a response.*

This event is triggered to handle a server client request. It does nothing,
because it is dedicated to extension.

.. code-block:: php

    $app->bind(AppEvent::DISPATCH, MyListener::class);


.. _api-events-priority:

Event Listener Priority
-----------------------

When attaching a listener to an event the priority integer could be specified. Positive number
is a higher priority than a negative one. If you do not provide any priority to a listener, it will be invoked
as soon after the main action triggers.

To standardize that, an event provides some constants of priorities using the ``WebinoEventLib\Event``.

Event::BEGIN
^^^^^^^^^^^^

*Handled at the beginning of an event.*

.. code-block:: php

    $app->bind($event, $listener, $event::BEGIN);


Event::BEFORE
^^^^^^^^^^^^^

*Handled before main event.*

.. code-block:: php

    $app->bind($event, $listener, $event::BEFORE);


Event::AFTER
^^^^^^^^^^^^

*Handled after main event.*

.. code-block:: php

    $app->bind($event, $listener, $event::AFTER);


Event::FINISH
^^^^^^^^^^^^^

*Handled at the end of an event.*

.. code-block:: php

    $app->bind($event, $listener, $event::FINISH);

Fine-tuning the priority
^^^^^^^^^^^^^^^^^^^^^^^^

You can always fine-tune your listener priority by adding *(earlier)* or substracting *(later)* an integer.

.. code-block:: php

    // earlier
    $app->bind($event, $listener, $event::BEGIN + 100);

    // later
    $app->bind($event, $listener, $event::BEGIN - 100);

