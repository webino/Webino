.. rst-class:: monospace

Application Caching API
=======================

.. contents::
    :depth: 1
    :local:

Cache Methods
-------------

.. contents::
    :depth: 1
    :local:


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

.. contents::
    :depth: 1
    :local:

.. include:: /api/config/cache.rst.inc
