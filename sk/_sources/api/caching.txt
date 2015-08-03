.. rst-class:: sub-monospace

=======================
Application Caching API
=======================

.. contents::
    :depth: 1
    :local:

.. rst-class:: monospace-topic

Cache Methods
=============

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


.. rst-class:: body-font

Cache Config
============

.. contents::
    :depth: 1
    :local:

.. include:: /api/config/cache.rst.inc
