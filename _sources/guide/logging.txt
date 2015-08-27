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


Logging Config
^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:

.. include:: /guide/config/logging.rst.inc


.. _api-logging:

Logging Interface
^^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


.. include:: /guide/api/logging.rst.inc


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
