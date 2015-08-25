.. rst-class:: sub-monospace

===================
Application Logging
===================

.. contents::
    :depth: 1
    :local:


Logs are important for monitoring the security of your application and to track events if problems occur,
as well as for auditing the correct usage of the system. The PSR-Logger interface standard is supported.

- Powered by `Zend Log <https://github.com/zendframework/zend-log>`_


.. _api-logging:

Logger Interface
^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


.. _api-logging-app-get-logger:

$app->getLogger()
-----------------

Obtaining logger service.

.. code-block:: php

    /** @var \WebinoLogLib\LoggerInterface $logger */
    $logger = $app->getLogger();

.. seealso::
   :ref:`Config Logger <config-logging-log>` ●
   `Logger Aware Example <http://demo.webino.org/logger-aware>`_


Obtaining custom logger service.

.. code-block:: php

    /** @var \WebinoLogLib\LoggerInterface $logger */
    $logger = $app->getLogger('myLogger');


.. seealso::
   :ref:`Config Custom Logger <config-logging-logger>` ●
   `Custom Logger Example <http://demo.webino.org/logger-custom>`_ ●
   `Custom Logger Aware Example <http://demo.webino.org/logger-aware-custom>`_


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
   `Log Message Example <http://demo.webino.org/logger-message>`_ ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`_


Obtaining PSR-3 logger.

.. code-block:: php

    /** @var \Psr\Log\LoggerInterface $logger */
    $logger = $app->log();


.. seealso::
   :ref:`api-logging-psr-3` ●
   `PSR-3 Logger Example <http://demo.webino.org/logger-PSR-3>`_


.. _api-logging-psr-3:

.. rst-class:: monospace-topic

PSR-3 Logger Interface
^^^^^^^^^^^^^^^^^^^^^^

Calling the ``$app->log()`` method without arguments returns the standard PSR-3 logger object,
on which we can call standard logging methods.

**Example:**

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


Logging Config
^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/logging.rst.inc


.. _config-logging-filters:

Logging Filters
^^^^^^^^^^^^^^^

A filter blocks a message from being written to the log.

.. contents::
    :depth: 1
    :local:


Priority filter
---------------

Configuring logger priority filter. Filters out all messages that are below required priority.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;
    use WebinoConfigLib\Feature\FirePhpLog;

    new CoreConfig([

        (new Log)->filterPriority(Log::EMERGENCY),

        (new FirePhpLog)->filterPriority(FirePhpLog::INFO),

        // etc.
    ]);


.. seealso::
   :ref:`config-logging-forking` ●
   `Logger Priority Filter Example <http://demo.webino.org/logger-filters-priority>`_


Regex filter
------------

Configuring logger regex filter. Filters out all messages that do not match required pattern.

.. code-block:: php

    use WebinoAppLib\Application\CoreConfig;
    use WebinoConfigLib\Feature\Log;
    use WebinoConfigLib\Feature\FirePhpLog;

    new CoreConfig([

        (new Log)->filterRegex('~^Attach~'),

        (new FirePhpLog)->filterRegex('~^Event~'),

        // etc.
    ]);


.. seealso::
   :ref:`config-logging-forking` ●
   `Logger Regex Filter Example <http://demo.webino.org/logger-filters-regex>`_


.. _api-log-messages:

Log Message Classes
^^^^^^^^^^^^^^^^^^^

The best practice is to log messages via class.

.. code-block:: php

    use WebinoLogLib\Message\AbstractDebugMessage;

    class MyDebugMessage extends AbstractDebugMessage
    {
        public function getMessage(array $args)
        {
            // do something...
            // $args[0]
            // $args[1]
            // $args['exception']

            // return a log message
            return 'My log message text with arguments {0} {1}';
        }
    }


.. seealso::
   :ref:`api-logging-app-log` ●
   :ref:`cookbook-logger-messages` ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`_



Use following log message classes in the ``WebinoLogLib\Message`` namespace to extend your custom
message classes.

**AbstractEmergencyMessage**
    *Emergency, the system is unusable.*

**AbstractAlertMessage**
    *Alert, immediate action is required.*

**AbstractCriticalMessage**
    *Critical, critical conditions.*

**AbstractErrorMessage**
    *Error, errors that do not require immediate attention but should be monitored.*

**AbstractWarningMessage**
    *Warning, unusual or undesirable occurrences that are not errors.*

**AbstractNoticeMessage**
    *Notice, normal but significant events.*

**AbstractInfoMessage**
    *Info, interesting events.*

**AbstractDebugMessage**
    *Debug, detailed information for debugging purposes.*


.. include:: /guide/cookbook/logging.rst.inc
