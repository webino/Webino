.. rst-class:: sub-monospace

====================
Application Services
====================

The application object behaves as a service container, that means we can register and retrieve services
directly from it.

.. contents::
    :depth: 1
    :local:


.. rst-class:: monospace-topic

Services Interface
^^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


$app->getServices()
-------------------

Accessing a service manager.

.. code-block:: php

    /** @var \Zend\ServiceManager\ServiceManager $services */
    $services = $app->getServices();


.. _api-services-app-get:

$app->get()
-----------

Getting a service from application.

.. code-block:: php

    /** @var \MyService $service */
    $service = $app->get('MyService');


$app->set()
-----------

Registering a service into application.

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

Checking wheater a service is available to application.

.. code-block:: php

    /** @var bool $hasService */
    $hasService = $app->has('MyService');


Services Config
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/services.rst.inc


.. include:: /guide/cookbook/services.rst.inc
