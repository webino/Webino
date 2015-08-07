Route
-----

*Adding routes via config.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\Route;

    new Config([

        (new Route('myRoute'))->setLiteral('/my/route/path'),

    ]);


- see: :ref:`api-routing-app-url` | :ref:`api-routing-app-bindRoute`
