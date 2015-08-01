.. rst-class:: monospace

Application Config API
======================

.. contents::
    :depth: 1
    :local:

Use application config API to set and get the application configuration.


Config Methods
--------------

The configuration is read only after application bootstrap.

.. contents::
    :depth: 1
    :local:


$app->getConfig()
^^^^^^^^^^^^^^^^^

It is possible to set configuration values before an application bootstrap.

*Setting a configuration value.*

.. code-block:: php

    $app->getConfig()->myConfigKey = 'myConfigValue';


*Getting a configuration value.*

.. code-block:: php

    /** @var \Zend\Config\Config|mixed $myConfig */
    $myConfig = $app->getConfig('myConfigKey', $default = null);


$app->getCoreConfig()
^^^^^^^^^^^^^^^^^^^^^

*Getting a core configuration value.*

.. code-block:: php

    /** @var \Zend\Config\Config|mixed $myCoreConfig */
    $myCoreConfig = $app->getCoreConfig('myCoreConfigKey', $default = null);


Config Features
---------------

.. contents::
    :depth: 1
    :local:

Config features are registered into the config like this:

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    new Config([

        new SomeConfigFeature, // <--

    ]);


Listener
^^^^^^^^

- namespace: **WebinoAppLib\\Feature**

Application listener config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Listener;

    new Config([

        new Listener(MyExampleListener::class), // <--

    ]);


CoreListener
^^^^^^^^^^^^

- namespace: **WebinoAppLib\\Feature**

Application core listener config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreListener;

    new CoreConfig([

        new CoreListener(MyExampleCoreListener::class), // <--

    ]);


Service
^^^^^^^

- namespace: **WebinoAppLib\\Feature**

Application service config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoAppLib\Feature\Service;

    new Config([

        new Service(MyExampleService::class), // <--

    ]);


CoreService
^^^^^^^^^^^

- namespace: **WebinoAppLib\\Feature**

Application core service config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\CoreService;

    new CoreConfig([

        new CoreService(MyExampleCoreService::class), // <--

    ]);


.. include:: /api/config/cache.rst.inc


Log
^^^

- namespace: **WebinoAppLib\\Feature**

Logging config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\Log;

    new CoreConfig([

        new Log, // <--

    ]);

FirePhpLog
^^^^^^^^^^

- namespace: **WebinoAppLib\\Feature**

FirePHP logging config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;

    new CoreConfig([

        new AppFeature\Log,
        new AppFeature\FirePhpLog, // <--

    ]);

