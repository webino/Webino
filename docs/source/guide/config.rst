.. rst-class:: sub-monospace

==================
Application Config
==================

.. contents::
    :depth: 1
    :local:


Use application config API to modify and access application configuration.


.. rst-class:: monospace-topic

Config Interface
================

.. note::
    The configuration is read-only after application is fully bootstrapped.

.. contents::
    :depth: 1
    :local:


.. _api-config-app-get-config:

$app->getConfig()
^^^^^^^^^^^^^^^^^

Accessing application configuration.

.. code-block:: php

    /** @var \Zend\Config\Config $config */
    $config = $app->getConfig();


.. note::
    It is possible to set configuration values before application is fully bootstrapped.


Setting configuration value.

.. code-block:: php

    $app->getConfig()->myConfigKey = 'myConfigValue';


Getting configuration value.

.. code-block:: php

    /** @var \Zend\Config\Config|mixed $myConfig */
    $myConfig = $app->getConfig('myConfigKey', $default = null);


$app->getCoreConfig()
^^^^^^^^^^^^^^^^^^^^^

Getting core configuration value.

.. code-block:: php

    /** @var \Zend\Config\Config|mixed $myCoreConfig */
    $myCoreConfig = $app->getCoreConfig('myCoreConfigKey', $default = null);


.. rst-class:: body-font sub-monospace

Config Features
===============

Config features are registered into the configuration like following:

.. code-block:: php

    Webino::config([
        new SomeConfigFeature,
    ]);


.. seealso::
   :ref:`api-config-app-get-config` ●
   `Config Feature Example <http://demo.webino.org/config-feature>`__


|vspace|

Available features:

.. contents::
    :depth: 2
    :local:


Events
^^^^^^

Use event system config features to configure listeners.

.. include:: /guide/config/events.rst.inc


Services
^^^^^^^^

Use services config features to configure invokable services and service factories.

.. include:: /guide/config/services.rst.inc


Logging
^^^^^^^

Use logging config features to configure logging.

.. include:: /guide/config/logging/log.rst.inc
.. include:: /guide/config/logging/forking.rst.inc
.. include:: /guide/config/logging/logger.rst.inc


Caching
^^^^^^^

Use cache config features to configure caching.

.. include:: /guide/config/caching.rst.inc


Filesystem
^^^^^^^^^^

Use filesystem config features to configure filesystems.

.. include:: /guide/config/filesystem.rst.inc


Routing
^^^^^^^

Use routing config features to configure routing.

.. include:: /guide/config/routing.rst.inc


.. include:: /guide/cookbook/config.rst.inc


