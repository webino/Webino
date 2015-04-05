.. rst-class:: monospace

Application Logging API
=======================

.. contents::
    :depth: 1
    :local:


Logs are important for monitoring the security of your application and to track events if problems occur,
as well as for auditing the correct usage of the system. The PSR-Logger interface standard is supported.

Application Logger Service
--------------------------

The best practice is to log a messaage via class.

$app->log()
^^^^^^^^^^^

*Writing a message to a log.*

.. code-block:: php

    // creating a debug message class
    use WebinoAppLib\Log\AbstractDebugMessage;

    class MyDebugMessage extends AbstractDebugMessage
    {
        public function getMessage(...$args)
        {
            // do something...

            // return a log message
            return 'My log message text with arguments {0} {1}';
        }
    }

    // logging a message
    $app->log(MyDebugMessage::class);

    // logging a message with custom arguments
    $app->log(MyDebugMessage::class, $argOne, $argTwo);

    // possible but not the best practice
    $app->log($app::DEBUG, 'My log message text', $argOne, $argTwo);


Available Log Message Classes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Use following log message classes in the ``WebinoAppLib\Log`` namespace to extend your custom
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


PSR-3-Logger Interface
----------------------

Calling the ``$app->log()`` method without arguments returns the standard PSR-3 logger object,
on which we can call standard logging methods.

**Example:**

.. code-block:: php

    // just text
    $app->log()->emergency('Something really bad happened.');

    // text with argument placeholders
    $app->log()->info('Message text example with variables: {0} {1}', [$argOne, $argTwo]);

    // text with context variables
    $app->log()->debug('Some debug information...', ['extra' => 'foo']);

|vspace|

Available methods:

$app->log()->emergency()
^^^^^^^^^^^^^^^^^^^^^^^^

*Emergency, the system is unusable.*

$app->log()->alert()
^^^^^^^^^^^^^^^^^^^^

*Alert, immediate action is required.*

$app->log()->critical()
^^^^^^^^^^^^^^^^^^^^^^^

*Critical, critical conditions.*

$app->log()->error()
^^^^^^^^^^^^^^^^^^^^

*Error, errors that do not require immediate attention but should be monitored.*

$app->log()->warning()
^^^^^^^^^^^^^^^^^^^^^^

*Warning, unusual or undesirable occurrences that are not errors.*

$app->log()->notice()
^^^^^^^^^^^^^^^^^^^^^

*Notice, normal but significant events.*

$app->log()->info()
^^^^^^^^^^^^^^^^^^^

*Info, interesting events.*

$app->log()->debug()
^^^^^^^^^^^^^^^^^^^^

*Debug, detailed information for debugging purposes.*
