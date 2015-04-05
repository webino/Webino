===========
Basic Usage
===========

.. code-block:: php

    <?php // index.php

    require 'vendor/autoload.php';

    $app = Webino::application()->boostrap();
    $app->dispatch();
