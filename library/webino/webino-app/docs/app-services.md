<? menu(BASICS, 'Services') ?>

# Application Services

Services are the foundation of the application architecture. A service is basically an object that provides some 
reusable functionality, like sending mails, storing data, rendering, etc. Services are the way that third-party 
libraries are plugged into the application also.

<?= toc() ?>

## Custom Application Service

Application implements the standard container interface `Psr\Container\ContainerInterface` so method `get()` is
used to retrieve object of required type.

<?= note('
It is not required to register the service class, if it exists, the service container will try to instantiate it.
') ?>

<?= example_php('App.services') ?>


To explicitly configure or override a service use the `set()` method.

<?= note('
Using interface to register services is a convenient way to support multiple implementations.
') ?>

<?= example_php('App.services.set') ?>


## Service Dependencies

It is very often that a service depends on other services, so these dependencies needs to be injected via class
constructor. The easiest way to construct an object is to add the static `create()` method to a class.

<?= example_php('App.services.create') ?>


Another way to create new service is via factory class implementing the `Webino\ServiceFactoryInterface`.

<?= example_php('App.services.factory') ?>
