--------------
Forking Logger
--------------

Creating new logger writer instead of overriding the default.

.. code-block:: php

    use WebinoConfigLib\Feature\Log;

    Webino::config([
        (new Log('my/folder/my-app.log'))->setName('my'),
    ]);


.. seealso::
   :ref:`config-logging-filters` ●
   `Logger Priority Filter Example <http://demo.webino.org/logger-filters-priority>`__ ●
   `Logger Regex Filter Example <http://demo.webino.org/logger-filters-regex>`__

