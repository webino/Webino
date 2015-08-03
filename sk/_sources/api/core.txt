.. rst-class:: monospace monospace-topic

====================
Application Core API
====================

Use application core API to access core services.

.. contents::
    :depth: 1
    :local:


$app->getServices()
^^^^^^^^^^^^^^^^^^^

*Accessing service manager.*

.. code-block:: php

    /** @var \Zend\ServiceManager\ServiceManager $services */
    $services = $app->getServices();


$app->getConfig()
^^^^^^^^^^^^^^^^^

*Accessing application configuration.*

.. code-block:: php

    /** @var \Zend\Config\Config $config */
    $config = $app->getConfig();


$app->getEvents()
^^^^^^^^^^^^^^^^^

*Accessing event manager service.*

.. code-block:: php

    /** @var \WebinoEventLib\EventManager $events */
    $events = $app->getEvents();


$app->getDebugger()
^^^^^^^^^^^^^^^^^^^

*Accessing debugger service.*

.. code-block:: php

    /** @var \WebinoAppLib\Service\DebuggerInterface $debugger */
    $debugger = $app->getDebugger();


$app->getLogger()
^^^^^^^^^^^^^^^^^

*Accessing logger service.*

.. code-block:: php

    /** @var \WebinoAppLib\Service\LoggerInterface $logger */
    $logger = $app->getLogger();


$app->getCache()
^^^^^^^^^^^^^^^^

*Accessing cache service.*

.. code-block:: php

    /** @var \Zend\Cache\Storage\StorageInterface $cache */
    $cache = $app->getCache();


$app->getFilesystems()
^^^^^^^^^^^^^^^^^^^^^^

*Accessing filesystem manager service.*

.. code-block:: php

    /** @var \Zend\ServiceManager\ServiceLocatorInterface $filesystems */
    $filesystems = $app->getFilesystems();

