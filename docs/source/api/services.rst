.. rst-class:: monospace

Application Services API
========================

Use services to handle your business logic.

$app->set()
-----------

*Registering a service into an application.*

.. code-block:: php

    // registering an invokable
    $app->set('MyInvokableService');

    // registering a factory
    $app->set('MyService', 'MyServiceFactory');

    // registering a factory object
    $app->set('MyService', new MyServiceFactory);

    // registering a closure factory
    $app->set('MyService', function () {
        return new MyService;
    });

    // setting an object
    $app->set('MyService', new MyService);

$app->get()
-----------

*Getting a service from an application.*

.. code-block:: php

    /** @var \MyService $service */
    $service = $app->get('MyService');
