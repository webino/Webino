==============
Advanced Usage
==============


.. contents::
    :depth: 1
    :local:

The application is basically a configuration and an execution code. The configuration is cached, if enabled so,
and could be modified until application is fully bootstrapped.

|vspace|

.. note::
    See ``examples/advanced-usage/`` directory.


Application Index File
======================

The application object is created, bootstrapped and dispatched in the index file.

.. code-block:: php

    <?php // index.php

    require 'vendor/autoload.php';

    $app = Webino::application()->bootstrap();
    $app->dispatch();



Application Configuration
=========================

Application is configured in the OOP style, so instead of writing an array we are using config features.

.. code-block:: php

    <?php // config/application.php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;
    use WebinoConfigLib\Feature as ConfigFeature;

    return new CoreConfig([
        new ConfigFeature\Log,
        new ConfigFeature\FirePhpLog,
        new ConfigFeature\ConfigCacheEnabled,
        new AppFeature\FilesystemCache,

        (new MyCustomFeature)
            ->setAnything(),
    ]);

