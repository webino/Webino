Logging Cookbook
^^^^^^^^^^^^^^^^

.. contents::
    :depth: 1
    :local:


.. _cookbook-logger-messages:

Creating Logger Messages
------------------------

Choose one of the abstract log messages in the ``WebinoLogLib\Message`` namespace.

Create file in your package folder with the name of your log message. For example ``Log\MyLogMessage.php``
with the following contents:

.. code-block:: php

    namespace MyPackage\Log;

    use WebinoLogLib\Message\AbstractDebugMessage;
    use Zend\Stdlib\Parameters;

    class MyLogMessage extends AbstractDebugMessage
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


.. seealso::
   :ref:`api-log-messages` ●
   `Log Message Class Example <http://demo.webino.org/logger-message-class>`_


Then you can log the message via application logger:

.. code-block:: php

    use MyPackage\Log\MyLogMessage;

    $app->log(MyLogMessage::class);


Or using custom logger, if you have configured one:

.. code-block:: php

    use MyPackage\Log\MyLogMessage;

    $app->getLogger('myLogger')->log(MyLogMessage::class);


.. seealso::
   :ref:`Config Custom Logger <config-logging-logger>` ●
   `Custom Logger Example <http://demo.webino.org/logger-custom>`_ ●
   `Custom Logger Aware Example <http://demo.webino.org/logger-aware-custom>`_


Creating Logger Aware Services
------------------------------

.. include:: /guide/cookbook/logging/create-service.rst.inc


Create a factory for your service to inject the logger. For example ``Factory\MyServiceFactory.php``
with the following contents:

.. code-block:: php

    namespace MyPackage\Factory;

    use MyPackage\Service\MyService;
    use WebinoAppLib\Factory\AbstractFactory;

    class MyServiceFactory extends AbstractFactory
    {
        protected function create()
        {
            $myService = new MyService;

            /**
             * Injecting app logger
             * into custom service.
             */
            $myService->setLogger($this->getApp()->getLogger());

            return $myService;
        }
    }


.. include:: /guide/cookbook/logging/service-factory-config.rst.inc


Then calling method on your service will write a message to the application log file.

.. code-block:: php

    use MyPackage\Service\MyService;

    /** @var MyService $myService */
    $myService = $app->get(MyService::class);
    $myService->doSomething();


.. seealso::
   :ref:`Service Factory <architecture-services-factory>` ●
   :ref:`Config Logger <config-logging-log>` ●
   `Logger Aware Example <http://demo.webino.org/logger-aware>`_


Creating Custom Loggers
-----------------------

.. include:: /guide/cookbook/logging/custom-logger-config.rst.inc


Then obtain your custom logger:

.. code-block:: php

    $myLogger = $app->getLogger('myLogger');


.. seealso::
   :ref:`Config Custom Logger <config-logging-logger>` ●
   `Custom Logger Example <http://demo.webino.org/logger-custom>`_


Creating Custom Logger Aware Services
-------------------------------------

.. include:: /guide/cookbook/logging/create-service.rst.inc


Create a factory for your service to inject your custom logger. For example ``Factory\MyServiceFactory.php``
with the following contents:

.. code-block:: php

    namespace MyPackage\Factory;

    use MyPackage\Service\MyService;
    use WebinoAppLib\Factory\AbstractFactory;

    class MyServiceFactory extends AbstractFactory
    {
        protected function create()
        {
            $myService = new MyService;

            /**
             * Injecting custom logger
             * into custom service.
             */
            $myService->setLogger($this->getApp()->getLogger('myLogger'));

            return $myService;
        }
    }


.. include:: /guide/cookbook/logging/custom-logger-config.rst.inc

.. include:: /guide/cookbook/logging/service-factory-config.rst.inc


Then calling method on your service will write a message to your custom log file.

.. code-block:: php

    use MyPackage\Service\MyService;

    /** @var MyService $myService */
    $myService = $app->get(MyService::class);
    $myService->doSomething();


.. seealso::
   :ref:`Service Factory <architecture-services-factory>` ●
   :ref:`Config Custom Logger <config-logging-logger>` ●
   `Custom Logger Aware Example <http://demo.webino.org/logger-aware-custom>`_

