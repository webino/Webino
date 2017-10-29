$app->getRouter()
-----------------

*Accessing router service.*

.. code-block:: php

    /** @var \Zend\Mvc\Router\RouteStackInterface $router */
    $router = $app->getRouter();


$app->route()
-------------

*Adding routes.*

.. code-block:: php

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route = $app->route(MyRoute::class)->setLiteral('/');
    // or via string
    $route = $app->route('myRoute')->setLiteral('/my/route/path');


.. _api-routing-app-bind:

$app->bind()
------------

*Binding to routes via class.*

.. code-block:: php

    use WebinoAppLib\Event\RouteEvent;

    /** @var \WebinoAppLib\Application\AbstractApplication $app */
    $app->bind(MyRoute::class, function (RouteEvent $event) {
        // do something...
    });


.. _api-routing-app-bindRoute:

$app->bindRoute()
-----------------

*Binding to routes via class or string.*

.. code-block:: php

    use WebinoAppLib\Event\RouteEvent;
    /** @var \WebinoAppLib\Application\AbstractApplication $app */

    // via class
    $app->bindRoute(MyRoute::class, function (RouteEvent $event) {
        // do something...
    });
    // via string
    $app->bindRoute('myRoute', function (RouteEvent $event) {
        // do something...
    });


.. _api-routing-app-url:

$app->url()
-----------

*Generating URLs.*

.. code-block:: php

    /** @var \WebinoAppLib\Router\UrlInterface $url */

    // via class
    $url = $app->url(MyRoute::class);
    // or via string
    $url = $app->url('myRoute');


*Generating URLs HTML.*

.. code-block:: php

    /** @var \WebinoBaseLib\Html\UrlHtmlInterface $urlHtml */

    // via class
    $urlHtml = $app->url(MyRoute::class)->html('My Route Label');
    // or via string
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

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route->setSegment('/:requiredParam[/:optionalParam]');


*Each segment may have constraints associated with it. Each constraint should simply be a regular expression
expressing the conditions under which that segment should match.*

.. code-block:: php

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route
        ->setSegment('/:requiredParam[/:optionalParam]')
        ->setConstraints([TODO...]);


*Also, as you can in other routes, you may provide defaults to use. These are particularly useful when using
optional segments.*

.. code-block:: php

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route
        ->setSegment('/:requiredParam[/:optionalParam]')
        ->setDefaults(['optionalParam' => 'defaultValue']);


.. seealso::
   `Segment Route Example <http://demo.webino.org/route-segment>`__


$route->setDefaults()
+++++++++++++++++++++

*Setting default route parameters.*

.. code-block:: php

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route->setDefaults(['optionalParam' => 'defaultValue']);


$route->setConstraints()
++++++++++++++++++++++++

*Setting route parameters constraints.*

TODO.....

.. code-block:: php

    /** @var \WebinoConfigLib\Feature\Route $route */
    $route->setConstraints(['optionalParam' => 'TODO...']);

