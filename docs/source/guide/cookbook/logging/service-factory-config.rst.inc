Add your service to the application via configuration.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Service;

    new Config([
        new Service(MyService::class, MyServiceFactory::class),
    ]);

