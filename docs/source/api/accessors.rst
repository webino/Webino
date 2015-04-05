.. rst-class:: monospace

Application Accessors
=====================

Used to retrieve core services from an application.

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


$app->getRequest()
------------------

*Getting a request.*

.. code-block:: php

    /** @var \Zend\Stdlib\RequestInterface $request */
    $request = $app->getRequest();


$app->setRequest()
------------------

*Setting a request.*

.. code-block:: php

    $request = new \Zend\Http\Request;
    $app->setRequest();

$app->getResponse()
-------------------

*Getting a response.*

.. code-block:: php

    /** @var \Zend\Stdlib\ResponseInterface $response */
    $response = $app->getResponse($request);


$app->setResponse()
-------------------

*Setting a response.*


.. code-block:: php

    $request = new \Zend\Http\Response;
    $app->setResponse($response);


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

    /** @var \Zend\Cache\Storage\StorageInterface $logger */
    $logger = $app->getCache();


$app->getFiles()
----------------

*Getting a filesystem manager service [TODO].*

.. code-block:: php

    /** @var \WebinoAppLib\Service\FilesInterface $files */
    $files = $app->getFiles();

