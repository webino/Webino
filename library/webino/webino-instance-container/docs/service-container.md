<? menu(USER_GUIDE, 'Service Container') ?>


# Service Container

The service container is the way to centralize construction of useful objects. These objects, named services,
may provide functionality like filesystem, database access, mail delivery, caching and so on.

<?= toc() ?>

<?= note('Service container implements the PSR-11 interface.') ?>


## New Service Container

It is required to instantiate the `Webino\ServiceContainer` class to use a service container object. 

<?= example_php('ServiceContainer.new') ?>


## Getting a Service

Use the `get()` method to access required service object.

<?= example_php('ServiceContainer.get') ?>

<?= note('
It is possible to get any class from the service container without setting it by default.
') ?>


## Setting a Service

To explicitly configure or override a service use the `set()` method.


### Service Class

It is possible to override the service implementation by the extended one.

<?= example_php('ServiceContainer.set') ?>

<?= note('
It is not required to register the service class, if it exists, the service container will try to instantiate it.
') ?>


### Service Interface

When using interface as a dependency it is required to set an object class to the service container.

<?= example_php('ServiceContainer.set.interface') ?>

<?= note('
Using interface to register services is a convenient way to support multiple implementations.
') ?>


### Service Object

It is possible to set an object instance as a service.

<?= example_php('ServiceContainer.set.object') ?>


## Service Dependencies

It is very often that a service depends on other services, so these dependencies needs to be injected via class
constructor. For example assume a custom service with some dependencies.

<?= example_php('ServiceContainer.dependencies') ?>

<?= note('
Documentation comment typehint `\object` is added to bypass IDE static type checking warnings.
') ?>


### Static Factory Method

The easiest way to construct an object with dependencies is to add the static `create()` method to a class.

<?= example_php('ServiceContainer.create') ?>


### Factory object class

Another way to create new service with dependencies is via factory class implementing the 
`Webino\ServiceFactoryInterface`.

<?= example_php('ServiceContainer.factory') ?>


### Closure factory

It is also possible to create a service via anonymous function.

<?= example_php('ServiceContainer.closure') ?>


## Custom Service Container

TODO...
