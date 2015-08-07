.. rst-class:: sub-monospace

===================
Application Caching
===================

.. contents::
    :depth: 1
    :local:

.. _api-caching-caching-methods:

.. rst-class:: monospace-topic

Caching Methods
^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


$app->getCaching()
------------------

*Accessing cache service.*

.. code-block:: php

    /** @var \Zend\Cache\Storage\StorageInterface $cache */
    $cache = $app->getCache();


$app->getCache()
----------------

*Getting cached value.*

.. code-block:: php

    $myValue = $app->getCache('myCacheKey');


$app->setCache()
----------------

*Setting value to cache.*

.. code-block:: php

    $app->setCache('myCacheKey', $myValue);


.. rst-class:: body-font


Cache Config
^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/caching.rst.inc

.. include:: /guide/cookbook/caching.rst.inc
