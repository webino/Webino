.. rst-class:: sub-monospace

========================
Application Services API
========================

The application object behaves as a service container, that means we can register and retrieve services
directly from it.

.. contents::
    :depth: 1
    :local:


.. rst-class:: monospace-topic

Services Methods
^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


$app->get()
-----------

*Getting a service from an application.*

.. code-block:: php

    /** @var \MyService $service */
    $service = $app->get('MyService');


$app->set()
-----------

*Registering a service into an application.*

.. code-block:: php

    // registering an invokable
    $app->set(MyInvokableService::class);

    // registering a factory
    $app->set('MyService', MyServiceFactory::class);

    // registering a factory object
    $app->set('MyService', new MyServiceFactory);

    // registering a closure factory
    $app->set('MyService', function () {
        return new MyService;
    });

    // setting an object
    $app->set('MyService', new MyService);


$app->has()
-----------

*Checking wheater a service is available to the application.*

.. code-block:: php

    /** @var bool $hasService */
    $hasService = $app->has('MyService');


Services Config
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /api/config/services.rst.inc
