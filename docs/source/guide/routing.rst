.. rst-class:: sub-monospace

===================
Application Routing
===================

.. contents::
    :depth: 1
    :local:


.. rst-class:: monospace-topic

Routing Methods
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


$app->getRouter()
-----------------

*Accessing router service.*

.. code-block:: php

    /** @var Zend\Mvc\Router\RouteStackInterface $router */
    $router = $app->getRouter();


$app->route()
-------------

*Adding routes.*

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route = $app->route('myRoute')->setLiteral('/my/route/path');


*Adding routes via class.*

.. code-block:: php

    use WebinoAppLib\Router\DefaultRoute;

    /** @var WebinoConfigLib\Feature\Route $route */
    $route = $app->route(DefaultRoute::class)->setLiteral('/');


.. _api-routing-app-bindRoute:

$app->bindRoute()
-----------------

*Binding to routes.*

.. code-block:: php

    use WebinoAppLib\Event\RouteEvent;

    /** @var WebinoAppLib\Application\AbstractApplication $app */
    $app->bindRoute('myRoute', function (RouteEvent $event) {
        // do something...
    });


*Binding to routes via class.*

.. code-block:: php

    use WebinoAppLib\Event\RouteEvent;
    use WebinoAppLib\Router\DefaultRoute;

    /** @var WebinoAppLib\Application\AbstractApplication $app */
    $app->bind(DefaultRoute::class, function (RouteEvent $event) {
        // do something...
    });


.. _api-routing-app-url:

$app->url()
-----------

*Generating URLs.*

.. code-block:: php

    /** @var WebinoAppLib\Router\UrlInterface $url */
    $url = $app->url('myRoute');


*Generating URLs via class.*

.. code-block:: php

    use WebinoAppLib\Router\DefaultRoute;

    /** @var WebinoAppLib\Router\UrlInterface $url */
    $url = $app->url(DefaultRoute::class);


*Generating URLs HTML.*

.. code-block:: php

    /** @var WebinoBaseLib\Html\UrlHtmlInterface $urlHtml */
    $urlHtml = $app->url('myRoute')->html('My Route Label');


|vspace|

Available route methods:

.. contents::
    :depth: 1
    :local:


$route->setLiteral()
++++++++++++++++++++

*Exact matching of the URI path. Configuration is solely the path you want to match.*

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route->setLiteral('/route/path');


$route->setSegment()
++++++++++++++++++++

*Matching any segment of a URI path. Segments are denoted using a colon, followed by alphanumeric characters.
If a segment is optional, it should be surrounded by brackets.*

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route->setSegment('/:requiredParam[/:optionalParam]');


*Each segment may have constraints associated with it. Each constraint should simply be a regular expression
expressing the conditions under which that segment should match.*

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route
        ->setSegment('/:requiredParam[/:optionalParam]')
        ->setConstraints([TODO...]);


*Also, as you can in other routes, you may provide defaults to use. These are particularly useful when using
optional segments.*

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route
        ->setSegment('/:requiredParam[/:optionalParam]')
        ->setDefaults(['optionalParam' => 'defaultValue']);


- see: `Segment Route Example <http://demo.webino.org/route-segment>`_

$route->setDefaults()
+++++++++++++++++++++

*Setting default route parameters.*

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route->setDefaults(['optionalParam' => 'defaultValue']);


$route->setConstraints()
++++++++++++++++++++++++

*Setting route parameters constraints.*

TODO.....

.. code-block:: php

    /** @var WebinoConfigLib\Feature\Route $route */
    $route->setConstraints(['optionalParam' => 'TODO...']);


.. rst-class:: body-font

Routing Config
^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/routing.rst.inc


Routing Events
^^^^^^^^^^^^^^

Following events are emitted during application routing.

.. contents::
    :depth: 1
    :local:


RouteEvent::MATCH
-----------------

*Route was matched.*

This event is emitted at beginning of application dispatch on route match.

.. code-block:: php

    use WebinoAppLib\Event\RouteEvent;

    $app->bind(RouteEvent::MATCH, function (RouteEvent $event) {});


RouteEvent::NO_MATCH
--------------------

*Can't match a route.*

This event is emitted at beginning of application dispatch when route can't be matched.

.. code-block:: php

    use WebinoAppLib\Event\DispatchEvent;
    use WebinoAppLib\Event\RouteEvent;

    $app->bind(RouteEvent::NO_MATCH, function (DispatchEvent $event) {});


Route Event
^^^^^^^^^^^

Following methods are provided by route event object.

.. contents::
    :depth: 1
    :local:


$event->getRouteMatch()
-----------------------

*Obtaining matched route object.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\RouteEvent $event */
    /** @var \Zend\Mvc\Router\Http\RouteMatch $routeMatch */
    $routeMatch = $event->getRouteMatch();


$event->getRouteParam()
-----------------------

*Accessing route parameters.*

.. code-block:: php

    /** @var \WebinoAppLib\Event\RouteEvent $event */
    $myParam = $event->getRouteParam('myParam');


.. include:: /guide/cookbook/routing.rst.inc
