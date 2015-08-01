.. rst-class:: monospace

Application Config API
======================

.. contents::
    :depth: 1
    :local:

Config Methods
--------------

After application bootstrap the configuration is read only.

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
