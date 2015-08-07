.. rst-class:: sub-monospace

============
Event System
============

.. contents::
    :depth: 1
    :local:

.. rst-class:: monospace-topic

Event Emitter Methods
^^^^^^^^^^^^^^^^^^^^^

Application can emit events and bind listeners to them.

.. contents::
    :depth: 1
    :local:


$app->getEvents()
-----------------

*Accessing event manager service.*

.. code-block:: php

    /** @var \WebinoEventLib\EventManager $events */
    $events = $app->getEvents();

.. _api-events-app-bind:

$app->bind()
------------

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

    // attaching an invokable object
    $app->bind(AppEvent::DISPATCH, new MyListener);

    // specifying a priority
    $app->bind(AppEvent::DISPATCH, $handler, AppEvent::BEGIN);

    // attaching a listener aggregate class
    $app->bind(MyListenerAggregate::class);

    // attaching a listener aggregate object
    $app->bind(new MyListenerAggregate);


$app->unbind()
--------------

*Unbinding a listener from an event.*

.. code-block:: php

    // for all events and priorities
    $app->unbind($handler);

    // for a specific event
    $app->unbind('someEvent', $handler);

    // for a specific priority too
    $app->unbind('someEvent', $handler, $priority);


$app->emit()
------------

*Emitting an event.*

.. code-block:: php

    // just emit an event
    $app->emit('myEvent');

    // event with custom arguments
    $app->emit('myEvent', [$argOne, $argTwo]);

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


Events Config
^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/events.rst.inc


.. rst-class:: monospace-topic

Application Core Events
^^^^^^^^^^^^^^^^^^^^^^^

Following events are emitted during an application core lifecycle.

.. contents::
    :depth: 1
    :local:


AppEvent::CONFIGURE
-------------------

*Configuring an application, merging modules configurations.*

This event is emitted in the middle of the two pass bootstrap event, allowing
you to merge an application configuration.

.. note::
    Only core listeners can bind to this event.

.. code-block:: php

    use WebinoAppLib\Event\AppEvent;

    $app->bind(AppEvent::CONFIGURE, function (AppEvent $event) {});


AppEvent::BOOTSTRAP
-------------------

*Initializing an application, all the services will be ready.*

After this two pass event all the services should be ready. The core listeners
binds to the first pass and a remaining can listen to the second pass bootstrap event.

.. code-block:: php

    use WebinoAppLib\Event\AppEvent;

    $app->bind(AppEvent::BOOTSTRAP, function (AppEvent $event) {});


AppEvent::DISPATCH
------------------

*Handling the client request and sending a response.*

This event is triggered to handle the server client request.

.. code-block:: php

    use WebinoAppLib\Event\AppEvent;
    use WebinoAppLib\Event\DispatchEvent;

    $app->bind(AppEvent::DISPATCH, function (DispatchEvent $event) {});


Dispatch Event
^^^^^^^^^^^^^^

Following methods are provided by the dispatch event object.

.. contents::
    :depth: 1
    :local:


$event->getApp()
----------------

*Obtaining application instance.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    /** @var \WebinoAppLib\Application\AbstractApplication $app */
    $app = $event->getApp();


$event->getRequest()
--------------------

*Obtaining request instance.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    /** @var \Zend\Stdlib\RequestInterface $request */
    $request = $event->getRequest();


$event->getResponse()
---------------------

*Obtaining response instance.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    /** @var \Zend\Stdlib\ResponseInterface $response */
    $response = $event->getResponse();


$event->setResponse()
---------------------

*Setting a response instance.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    /** @var \Zend\Stdlib\ResponseInterface $response */
    $event->setResponse($response);


$event->setResponseContent()
----------------------------

*Setting a response text, it will appended to the already existing one.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    $event->setResponseContent('Example response content.');


$event->resetResponseContent()
------------------------------

*Setting a response text, clearing the already existing one.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    $event->resetResponseContent('Example response content.');


$event->setResponseStream()
---------------------------

*Setting a response stream.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\DispatchEvent $event */
    /** @var resource $stream */
    $stream = $event->getApp()->file()->readStream('path/to/file.txt');
    $event->setResponseStream($stream);


.. _api-events-priority:

.. rst-class:: monospace-topic

Event Listener Priority
^^^^^^^^^^^^^^^^^^^^^^^

When attaching a listener to an event the priority integer could be specified. Positive number
is a higher priority than a negative one. If you do not provide any priority to a listener, it will be invoked
as soon after the main action triggers.

Event provides some constants for priorities:

.. contents::
    :depth: 1
    :local:


Event::BEGIN
------------

*Handled at the beginning of an event.*

.. code-block:: php

    use WebinoEventLib\Event;

    $app->bind('myEvent', function (Event $event) {}, Event::BEGIN);


Event::BEFORE
-------------

*Handled before main event.*

.. code-block:: php

    use WebinoEventLib\Event;

    $app->bind('myEvent', function (Event $event) {}, Event::BEFORE);


Event::AFTER
------------

*Handled after main event.*

.. code-block:: php

    use WebinoEventLib\Event;

    $app->bind('myEvent', function (Event $event) {}, Event::AFTER);


Event::FINISH
-------------

*Handled at the end of an event.*

.. code-block:: php

    use WebinoEventLib\Event;

    $app->bind('myEvent', function (Event $event) {}, Event::FINISH);


Fine Tuning The Priority
^^^^^^^^^^^^^^^^^^^^^^^^

You can always fine-tune your listener priority by adding *(earlier)* or substracting *(later)* an integer.

.. code-block:: php

    use WebinoEventLib\Event;

    // earlier
    $app->bind('myEvent', function (Event $event) {}, Event::BEGIN + 100);

    // later
    $app->bind('myEvent', function (Event $event) {}, Event::BEGIN - 100);


.. include:: /guide/cookbook/events.rst.inc
