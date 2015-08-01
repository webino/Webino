Basic Usage
===========

Application entry point
-----------------------

The application object is created, bootstrapped and dispatched in the index file.

.. code-block:: php

    <?php // public/index.php

    require 'vendor/autoload.php';

    $app = Webino::application()->boostrap();
    $app->dispatch();



Application configuration
-------------------------

Application is configured in the OOP style, so instead of writing an array we are using config features.

.. code-block:: php

    <?php // config/application.php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\FilesystemCache;
    use WebinoConfigLib\Feature\ConfigCacheEnabled;
    use WebinoConfigLib\Feature\Log;

    return new CoreConfig([
        new ConfigCacheEnabled,
        new FilesystemCache,
        new Log,
    ]);
