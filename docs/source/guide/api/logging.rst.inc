.. _api-logging-app-get-logger:

$app->getLogger()
-----------------

Obtaining logger service.

.. code-block:: php

    /** @var \WebinoLogLib\LoggerInterface $logger */
    $logger = $app->getLogger();

.. seealso::
   :ref:`Config Logger <config-logging-log>` ●
   `Logger Aware Example <http://demo.webino.org/logger-aware>`__


Obtaining custom logger service.

.. code-block:: php

    /** @var \WebinoLogLib\LoggerInterface $logger */
    $logger = $app->getLogger('myLogger');


.. seealso::
   :ref:`Config Custom Logger <config-logging-logger>` ●
   `Custom Logger Example <http://demo.webino.org/logger-custom>`__ ●
   `Custom Logger Aware Example <http://demo.webino.org/logger-aware-custom>`__


.. _api-logging-app-log:

$app->log()
-----------

Writing messages to a log.

.. code-block:: php

    // creating a debug message class
    use WebinoLogLib\Message\AbstractDebugMessage;
    use Zend\Stdlib\Parameters;

    class MyDebugMessage extends AbstractDebugMessage
    {
        public function getMessage(Parameters $args)
        {
            // do something...
            // $args[0]
            // $args[1]
            // $args->exception

            // return a log message
            return 'My log message text with arguments {0} {1}';
        }
    }

    // logging a message
    $app->log(MyDebugMessage::class);

    // logging a message with custom arguments
    $app->log(MyDebugMessage::class, [$argOne, $argTwo]);

    // possible but not the best practice
    $app->log($app::DEBUG, 'My log message text with arguments {0} {1}', [$argOne, $argTwo]);


.. seealso::
   :ref:`api-log-messages` ●
   `Log Message Example <http://demo.webino.org/logger-message>`__ ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`__


Obtaining PSR-3 logger.

.. code-block:: php

    /** @var \Psr\Log\LoggerInterface $logger */
    $logger = $app->log();


.. seealso::
   :ref:`api-logging-psr-3` ●
   `PSR-3 Logger Example <http://demo.webino.org/logger-PSR-3>`__


.. _api-logging-psr-3:

.. rst-class:: monospace-topic

PSR-3 Logger Interface
^^^^^^^^^^^^^^^^^^^^^^

Calling the ``$app->log()`` method without arguments returns the standard PSR-3 logger object,
on which we can call standard logging methods.

.. code-block:: php

    // just text
    $app->log()->emergency('Something really bad happened.');

    // text with argument placeholders
    $app->log()->info('Message text example with arguments: {0} {1}', [$argOne, $argTwo]);

    // text with context variables
    $app->log()->debug('Some debug information...', ['exception' => $exc]);


|vspace|

Available methods:

.. contents::
    :depth: 1
    :local:


$app->log()->emergency()
------------------------

*Emergency, the system is unusable.*


$app->log()->alert()
--------------------

*Alert, immediate action is required.*


$app->log()->critical()
-----------------------

*Critical, critical conditions.*


$app->log()->error()
--------------------

*Error, errors that do not require immediate attention but should be monitored.*


$app->log()->warning()
----------------------

*Warning, unusual or undesirable occurrences that are not errors.*


$app->log()->notice()
---------------------

*Notice, normal but significant events.*


$app->log()->info()
-------------------

*Info, interesting events.*


$app->log()->debug()
--------------------

*Debug, detailed information for debugging purposes.*
