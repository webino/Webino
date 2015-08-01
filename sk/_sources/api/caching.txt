.. rst-class:: monospace

Application Caching API
=======================

.. contents::
    :depth: 1
    :local:

Cache Methods
-------------

$app->getCache()
^^^^^^^^^^^^^^^^

*Getting cached value.*

.. code-block:: php

    $myValue = $app->getCache('myCacheKey');


$app->setCache()
^^^^^^^^^^^^^^^^

*Setting value to cache.*

.. code-block:: php

    $app->setCache('myCacheKey', $myValue);


Cache Config
------------

.. todo::
    Write cache config features list (different types of cache storage).
