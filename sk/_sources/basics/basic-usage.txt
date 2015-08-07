===========
Basic Usage
===========

.. contents::
    :depth: 1
    :local:


The application is basically a configuration and an execution code.

|vspace|

.. note::
    See ``examples/basic-usage/`` directory.


Index File
==========

The application object is configured, created, bootstrapped and dispatched in the index file.

.. code-block:: php

    <?php // index.php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature as AppFeature;
    use WebinoConfigLib\Feature as ConfigFeature;

    require 'vendor/autoload.php';

    /**
     * Configure and create an application.
     * Use configurators instead of writing PHP arrays.
     * Create your custom configurators.
     */

    $config = new CoreConfig([
        new ConfigFeature\Log,
        new ConfigFeature\FirePhpLog,
        new AppFeature\FilesystemCache,

        (new MyCustomFeature)
            ->setAnything(),
    ]);

    $appCore = Webino::application($config);

    /**
     * Application $appCore is not fully configured.
     * Only core services and listeners are available.
     * Configuration is write enabled.
     */

    $app = $appCore->bootstrap();

    /**
     * Application $app is configured and ready for a dispatch.
     * All services and listeners are available.
     * Configuration is read-only.
     */

    $app->dispatch();


Routing
=======

A route is a map from a URL path to an event. When a route gets hit it will trigger an event on which you can bind
custom code.

.. contents::
    :depth: 1
    :local:


Adding routes
^^^^^^^^^^^^^

*Adding routes via configuration.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\Route;

    new Config([
        (new Route('myRoute'))->setLiteral('/my/route/path'),
    ]);


*Adding routes runtime.*

.. code-block:: php

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route = $app->route('myRoute')->setLiteral('/my/route/path');


Generating URLs
^^^^^^^^^^^^^^^

*Generating URLs to application routes.*

.. code-block:: php

    /** @var WebinoAppLib\Router\UrlInterface $url */
    $url = $app->url('myRoute');


Binding to routes
^^^^^^^^^^^^^^^^^

*Handling route match.*

.. code-block:: php

    use WebinoAppLib\Event\RouteEvent;

    $app->bindRoute('myRoute', function (RouteEvent $event) {
        // do something...
    });


Requests
========

TODO...


Responses
=========

TODO...
