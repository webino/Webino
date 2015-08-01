ConfigCacheEnabled
^^^^^^^^^^^^^^^^^^

- namespace: **WebinoConfigLib\\Feature**

Application config cache enabled config feature.

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\ConfigCacheEnabled;

    new Config([

        new ConfigCacheEnabled, // <--

    ]);


FilesystemCache
^^^^^^^^^^^^^^^

- namespace: **WebinoAppLib\\Feature**

Application filesystem cache config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\FilesystemCache;

    new CoreConfig([

        new FilesystemCache, // <--

    ]);


MemoryCache
^^^^^^^^^^^

- namespace: **WebinoAppLib\\Feature**

Application memory cache config feature.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\MemoryCache;

    new CoreConfig([

        new MemoryCache, // <--

    ]);

