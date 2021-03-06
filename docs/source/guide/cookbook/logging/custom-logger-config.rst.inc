Add new logger feature to application configuration:

.. code-block:: php

    use WebinoAppLib\Feature\Config;
    use WebinoConfigLib\Feature\FirePhpLog;
    use WebinoConfigLib\Feature\Log;
    use WebinoConfigLib\Feature\Logger

    Webino::config([
        new Logger('myLogger', [
            new Log('my.log'),
        ]),
    ]);

