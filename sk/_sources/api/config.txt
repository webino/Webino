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

.. todo::
    Write a list of application config features.

.. contents::
    :depth: 1
    :local:

Config features are registered into the config like this:

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        new SomeConfigFeature, // <--

    ]);


WebinoAppLib\\Feature\\Listener
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Application listener config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        // TODO, // <--

    ]);


WebinoAppLib\\Feature\\CoreListener
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Application core listener config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        // TODO, // <--

    ]);


WebinoAppLib\\Feature\\Service
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Application service config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        // TODO, // <--

    ]);


WebinoAppLib\\Feature\\CoreService
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Application core service config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        // TODO, // <--

    ]);


WebinoAppLib\\Feature\\FilesystemCache
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Application filesystem cache config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        // TODO, // <--

    ]);

WebinoAppLib\\Feature\\MemoryCache
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Application memory cache config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    return new Config([

        // TODO, // <--

    ]);

