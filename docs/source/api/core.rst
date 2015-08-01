.. rst-class:: monospace

Application Core API
====================

Use application core API to access core services.

.. contents::
    :depth: 1
    :local:


$app->getServices()
-------------------

*Getting a service manager.*

.. code-block:: php

    /** @var \Zend\ServiceManager\ServiceManager $services */
    $services = $app->getServices();


$app->getConfig()
-----------------

*Getting an application configuration.*

.. code-block:: php

    /** @var \Zend\Config\Config $config */
    $config = $app->getConfig();


$app->getEvents()
-----------------

*Getting an event manager service.*

.. code-block:: php

    /** @var \WebinoEventLib\EventManager $events */
    $events = $app->getEvents();


$app->getDebugger()
-------------------

*Getting a debugger service.*

.. code-block:: php

    /** @var \WebinoAppLib\Service\DebuggerInterface $debugger */
    $debugger = $app->getDebugger();


$app->getLogger()
-----------------

*Getting a logger service.*

.. code-block:: php

    /** @var \WebinoAppLib\Service\LoggerInterface $logger */
    $logger = $app->getLogger();


$app->getCache()
----------------

*Getting a cache service.*

.. code-block:: php

    /** @var \Zend\Cache\Storage\StorageInterface $cache */
    $cache = $app->getCache();


$app->getFile()
---------------

*Getting a filesystem manager service [TODO].*

.. code-block:: php

    /** @var \WebinoAppLib\Service\FilesInterface $files */
    $files = $app->getFiles();

