Service
-------

Configuring services.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Service;

    new Config([
        // invokable
        new Service(MyExampleService::class),
        // factory
        new Service(MyExampleService::class, MyExampleServiceFactory::class),
    ]);


- see: :ref:`api-services-app-get`


CoreService
-----------

Application core service config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreService;

    new CoreConfig([
        new CoreService(MyExampleCoreService::class),
    ]);


- see: :ref:`architecture-services` | :ref:`api-services-app-get`
