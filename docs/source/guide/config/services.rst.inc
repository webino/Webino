Service
-------

Configuring services.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Service;

    new Config([
        // invokable
        new Service(MyService::class),
        // factory
        new Service(MyService::class, MyServiceFactory::class),
    ]);


.. seealso::
   :ref:`api-services-app-get` |
   :ref:`architecture-services-invokables` |
   :ref:`architecture-services-factory`


CoreService
-----------

Application core service config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreService;

    new CoreConfig([
        // invokable
        new CoreService(MyCoreService::class),
        // factory
        new CoreService(MyCoreService::class, MyCoreServiceFactory::class),
    ]);


.. seealso::
   :ref:`api-services-app-get` |
   :ref:`architecture-services-core` |
   :ref:`architecture-services-invokables` |
   :ref:`architecture-services-factory`
