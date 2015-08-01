Basic Usage
===========

.. contents::
    :depth: 1
    :local:

The application is basically a configuration and an execution code. The configuration is cached if enabled and could
be modified until bootstrap.

Application entry point
-----------------------

The application object is created, bootstrapped and dispatched in the index file.

.. code-block:: php

    <?php // public/index.php

    require 'vendor/autoload.php';

    $app = Webino::application()->bootstrap();
    $app->dispatch();



Application configuration
-------------------------

Application is configured in the OOP style, so instead of writing an array we are using config features.

.. code-block:: php

    <?php // config/application.php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;
    use WebinoConfigLib\Feature as ConfigFeature;

    return new CoreConfig([
        new ConfigFeature\Log,
        new ConfigFeature\ConfigCacheEnabled,
        new AppFeature\FilesystemCache,

        (new MyCustomFeature)
            ->setAnything(),
    ]);
