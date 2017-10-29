DefaultFilesystem
-----------------

Overriding default local working dir filesystem.

.. code-block:: php

    use WebinoAppLib\Feature\DefaultFilesystem;

    Webino::config([
        // optional
        new DefaultFilesystem('custom/root'),
    ]);


.. seealso::
   :ref:`api-filesystem-app-file`


MemoryFilesystem
----------------

Configuring temporary filesystem in the memory.

.. code-block:: php

    use WebinoAppLib\Feature\MemoryFilesystem;

    Webino::config([
        new MemoryFilesystem,
    ]);


.. seealso::
   :ref:`api-filesystem-app-file` ●
   `Filesystem Config Example <http://demo.webino.org/filesystem-config>`__
