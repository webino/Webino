Application Event System
========================

.. contents::
    :depth: 1
    :local:

The Webino™ architecture is event driven, thus extensible. We can attach listeners to events,
performing other operations as they trigger.


Event Lifecycle
---------------

The basic idea around events is that we just trigger an event and every action happens in listeners,
even the main action. Then we can listen to that event using priorities, if we want to act like a middleware.
The event propagation could be stopped at any time.

.. image:: ../_static/media/WebinoEventLib.Event.Lifecycle_h400.png
    :class: centered


Using events like *someEvent.pre* and *someEvent.post* or *someEvent.before*, *someEvent.after*, it doesn't matter,
is messy and not recommended, don't do that. Give an event a unique name then attach listeners using priorities.
Convenient way to do that is to use the event `priority constants <#event-listener-priority>`_.


Event Listeners
---------------

The event listener is a callable peiece of code that can perform actions when event is emitted.
It is allowed to register an event listeners in some different ways.

Closure Listener
^^^^^^^^^^^^^^^^

*The closure listener is the fastest created listener, but not a best practice at all.*

.. code-block:: php

    use WebinoEventLib\Event;

    $app->bind('someEvent', function (Event $event) {
        // do something...
    });

Invokable Listener
^^^^^^^^^^^^^^^^^^

*The invokable listener is a class that its object can be called like a function*

.. code-block:: php

    use WebinoEventLib\Event;

    class MyInvokableListener
    {
        public function __invoke(Event $event)
        {
            // do something...
        }
    }

    // lazy loading
    $app->bind('someEvent', MyInvokableListenner::class);

    // as an object
    $app->bind('someEvent', new MyInvokableListenner);


Listener Aggregate
^^^^^^^^^^^^^^^^^^

*The listener aggregate is a class that register other listeners in a batch.*

.. code-block:: php

    use WebinoEventLib\Event;
    use WebinoEventLib\Listener\AbstractListener;

    class MyListenerAggregate extends AbstractListener
    {
        public function init()
        {
            // handle an event by itself
            $this->listen('someEvent', 'onSomeEvent');

            // handle an event by closure
            $this->listen('someEvent', function (Event $event) {
                // do something...
            });

            // handle an event by invokable
            $this->listen('someEvent', SomeInvokableListener::class);

            // handle an event by its collaborator
            $eventProcessor = new \MyEventProcessor;
            $this->listen('someEvent', [$eventProcessor, 'onEvent']);
        }

        public function onSomeEvent(Event $event)
        {
            // do something...
        }
    }

    // lazy loading
    $app->bind('someEvent', MyListenerAggregate::class);

    // as an object
    $app->bind('someEvent', new MyListenerAggregate);


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

*Handled before a main event.*

.. code-block:: php

    $app->bind($event, $listener, $event::BEFORE);


Event::AFTER
^^^^^^^^^^^^

*Handled after a main event.*

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

