ConfigCacheEnabled
------------------

Toggling application config caching.

.. code-block:: php

    use WebinoConfigLib\Feature\ConfigCacheEnabled;

    Webino::config([
        // enable
        new ConfigCacheEnabled,
        // disable
        new ConfigCacheEnabled(false),
    ]);


.. seealso::
   :ref:`api-caching-caching-methods`


FilesystemCache
---------------

Configuring filesystem cache.

.. code-block:: php

    use WebinoAppLib\Feature\FilesystemCache;

    Webino::config([
        new FilesystemCache,
    ]);


MemoryCache
-----------

Configuring in memory cache.

.. code-block:: php

    use WebinoAppLib\Feature\MemoryCache;

    Webino::config([
        new MemoryCache,
    ]);

