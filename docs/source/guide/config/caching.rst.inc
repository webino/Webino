ConfigCacheEnabled
------------------

*Toggling application config caching.*

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\ConfigCacheEnabled;

    new Config([

        // enable
        new ConfigCacheEnabled,

        // disable
        new ConfigCacheEnabled(false),

    ]);


- see: :ref:`api-caching-caching-methods`


FilesystemCache
---------------

*Configuring filesystem cache.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\FilesystemCache;

    new CoreConfig([

        new FilesystemCache,

    ]);


MemoryCache
-----------

*Configuring in memory cache.*

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\MemoryCache;

    new CoreConfig([

        new MemoryCache,

    ]);

