DefaultFilesystem
-----------------

- namespace: ``WebinoAppLib\Feature``
- scope: *Local working dir.*

Overriding an application default filesystem.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\DefaultFilesystem;

    new CoreConfig([

        // optional
        new DefaultFilesystem('custom/root'), // <--

    ]);


Obtaining default filesystem instance.

.. code-block:: php

    use WebinoAppLib\Filesystem\LocalFiles;

    $defaultFilesystem = $app->files();
    // or
    $defaultFilesystem = $app->files(LocalFiles::class);


MemoryFilesystem
----------------

- namespace: ``WebinoAppLib\Feature``
- scope: *Temporary filesystem in the memory*

Application filesystem in the memory.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoAppLib\Feature\MemoryFilesystem;

    new CoreConfig([

        new MemoryFilesystem, // <--

    ]);


Obtaining memory filesystem instance.

.. code-block:: php

    use WebinoAppLib\Filesystem\InMemoryFiles;

    $memoryFilesystem = $app->files(InMemoryFiles::class);
