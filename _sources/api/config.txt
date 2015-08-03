.. rst-class:: sub-monospace

======================
Application Config API
======================

.. contents::
    :depth: 1
    :local:

Use application config API to modify and access the application configuration.


.. rst-class:: monospace-topic

Config Methods
==============

.. note::
    The configuration is read-only after an application is fully bootstrapped.

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


.. rst-class:: body-font sub-monospace

Config Features
===============

Config features are registered into the config like this:

.. code-block:: php

    use WebinoAppLib\Feature\Config;

    new Config([

        new SomeConfigFeature, // <--

    ]);


|vspace|

Available features:

.. contents::
    :depth: 2
    :local:


Events
^^^^^^

Use event system config features to configure listeners.

.. include:: /api/config/events.rst.inc


Services
^^^^^^^^

Use services config features to configure invokable services and service factories.

.. include:: /api/config/services.rst.inc


Logging
^^^^^^^

Use logging config features to configure logging.

.. include:: /api/config/logging.rst.inc


Cache
^^^^^

Use cache config features to configure caching.

.. include:: /api/config/cache.rst.inc


Filesystem
^^^^^^^^^^

Use filesystem config features to configure filesystems.

.. include:: /api/config/filesystem.rst.inc
