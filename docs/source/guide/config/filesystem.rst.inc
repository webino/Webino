DefaultFilesystem
-----------------

Overriding default local working dir filesystem.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\DefaultFilesystem;

    new CoreConfig([
        // optional
        new DefaultFilesystem('custom/root'),
    ]);


- see: :ref:`api-filesystem-app-file`


MemoryFilesystem
----------------

Configuring temporary filesystem in the memory.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\MemoryFilesystem;

    new CoreConfig([
        new MemoryFilesystem,
    ]);


- see: :ref:`api-filesystem-app-file`
