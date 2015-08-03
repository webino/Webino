Service
-------

- namespace: ``WebinoAppLib\Feature``

*Application service config feature.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Service;

    new Config([

        new Service(MyExampleService::class), // <--

    ]);


*Obtaining service instance.*

.. code-block:: php

    $service = $app->get(MyExampleService::class); // <--


CoreService
-----------

- namespace: ``WebinoAppLib\Feature``

*Application core service config feature.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreService;

    new CoreConfig([

        new CoreService(MyExampleCoreService::class), // <--

    ]);


*Obtaining core service instance.*

.. code-block:: php

    $service = $app->get(MyExampleCoreService::class); // <--
