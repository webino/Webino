==============
Advanced Usage
==============

Application configuration and execution code could be placed into a single file.

|vspace|

.. note::
    See ``examples/advanced-usage/`` directory.


Single File Application
=======================

The application object is configured, created, bootstrapped and dispatched in the index file.

.. code-block:: php

    <?php // index.php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;
    use WebinoConfigLib\Feature as ConfigFeature;

    require 'vendor/autoload.php';

    $config = new CoreConfig([
        new ConfigFeature\Log,
        new ConfigFeature\ConfigCacheEnabled,
        new AppFeature\FilesystemCache,

        (new MyCustomFeature)
            ->setAnything(),
    ]);

    $appCore = Webino::application($config);

    $app = $appCore->bootstrap();

    $app->dispatch();

