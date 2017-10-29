Route
-----

Adding routes via config.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\Route;

    Webino::config([
        (new Route('myRoute'))->setLiteral('/my/route/path'),
    ]);


.. seealso::
   :ref:`api-routing-app-url` ●
   :ref:`api-routing-app-bindRoute` ●
   `Route Config Example <http://demo.webino.org/route-config>`__
