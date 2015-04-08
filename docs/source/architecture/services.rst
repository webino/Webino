Application Services
====================

.. contents::
    :depth: 1
    :local:

Services are the foundation of the application architecture. A service is basically an object that provides some
reusable functionality, like sending mails, storing data, rendering, etc. Services are the way that third-party
libraries are plugged into the application also.

.. image:: ../_static/media/WebinoAppLib.Services_h200.png
    :class: centered

Services are powered by the Zend Framework 2 ServiceManager component and we decide that a best practice
is to use only invokables and factories. Using a magic to resolve services dependencies via some DI container
isn't implemented, because with large projects it becomes messy and slow.


Invokables
----------

An invokable service is a class that may be called like an ordinary function, or may not. It depends on its interface,
but for a sake we call them all invokables, if they doesn't have a constructor dependencies.

.. code-block:: php

    class MyInvokableService
    {
        public function __invoke()
        {

        }

        public function someServiceMethod()
        {

        }
    }

Adding and accessing an invokable service via application.

.. code-block:: php

    // lazy loading
    $app->set(MyInvokableService::class);

    /** @var MyInvokableService $service */
    $service = $app->get(MyInvokableService::class);


Service Factory
---------------

In a case when we want to create a complex service with dependencies, it's required to create a factory.

.. code-block:: php

    use WebinoAppLib\Factory\AbstractFactory;

    class MyServiceFactory extends AbstractFactory
    {
        protected function create()
        {
            return new MyService;
        }
    }

Adding and accessing a service created by a factory via application.

.. code-block:: php

    // lazy loading
    $app->set(MyService::class, MyServiceFactory::class);

    /** @var MyService $service */
    $service = $app->get(MyService::class);

