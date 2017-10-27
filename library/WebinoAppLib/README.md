# WebinoAppLib - Webino™ Application Core Library

The HTTP and CLI request responder.

## QuickUse

The basic concept is to bootstrap services and to respond to the client request.

    <?php
    
    require 'vendor/autoload.php';
    
    $app = WebinoAppLib::application()->bootstrap();
    $app->dispatch();


## Application Architecture

The Webino application architecture is composed of its own code and other useful open-source libraries, mainly
Zend Framework.

### Application Lifecycle

Because of two pass application bootstrap process, the core services and listeners are initialized first. So they are
ready before first pass bootstrap event occurs. The remaining services and listeners are initialized after the
configure event, right before second pass bootstrap occurs. So only core listeners can listen to the configure event.

![Flowchart](https://raw.githubusercontent.com/webino/WebinoAppLib/master/docs/media/WebinoAppLib.Flowchart_h400.png "WebinoAppLib - Flowchart")

**Advanced initialization code example:**

    <?php
    
    namespace WebinoAppLib;
    
    // 1)
    $appCore = \WebinoAppLib::application(
        array|ConfigInterface $config = null, 
        DebuggerInterface $debugger = null
    );
    
    (add bootstrap listeners at runtime here)
    
    // 2)
    /** @var Application\ConfiguredApplication $app **/
    $app = $appCore->bootstrap();
    
    (configure routes, event listeners, etc. at runtime here)
    
    // 3)
    /** @var Application\DispatchedApplication $app **/
    $app->dispatch();
    
**Explanation:**

0. Creating new application object, loading configuration and debugger.
    - There are two optional arguments, for the config and the debugger objects.
    - If those arguments are not provided, the application factory tries to require them from files
    `config/application.php` and `config/debugger.php`, if that fails too, the factory creates a default
    configuration and a null debugger objects.  
    - Factory then creates the application services manager and sets a debugger to it.
    - Finally an application is created and registered into services too.

0. Initializing application, all services are ready.
    - The application config is allowed for modifications during initialization.
    - Calling the `bootstrap()` method triggers the two pass application bootstrap event.
        - First pass is handled by core listeners and it allows them to listen to the configure event and
          to a second pass of the bootstrap.
        - Then application configuration event is triggered, but skipped if cached config is available.
        - Second pass of the bootstrap is handled by remaining listeners, allowing them to perform actions
          before application is dispatched.

0. Handle the client request and send a response.
    - Calling the `dispatch()` method just triggers the dispatch event, what then will happen is up to you.

### Application Events

- `bootstrap` - First pass, initializing core services and listeners. *(only for core listeners)*

- [`configure`] - Configuring an application, optional if cache is available. *(only for core listeners)*

- `bootstrap` - Second pass, initializing remaining services and listeners.
    
- `dispatch` - Responding to the client request.

### Core configuration structure

The base of an application are services and listeners. Services provides functionality while listeners listens
to the events and then calls methods on those services when event is triggered.

- **Configuration**
    - **Core**
        - **Services**
            - **Invokables**
            - **Factories**
        - **Listeners**
    - **Services**
        - **Invokables**
        - **Factories**
    - **Listeners**

Services should be invokables or created by a factory, it is not recommended to use any magic around
service creation.

### Class Diagram for the Application Object

The application is divided into two types, the basic type and the configured one. While all general application methods
are available throughout whole life cycle, the `bootstrap()` method can be called only on a basic type and the `dispatch()`
on a cofigured type.

![Application Class Diagram](https://raw.githubusercontent.com/webino/WebinoAppLib/master/docs/media/WebinoAppLib.Application.ClassDiagram_w720.png "WebinoAppLib - Application Class Diagram")

### Core Services

- **Config** - Application configuration
- **Events** - Event manager
- **Debugger** - Debugging
- **Logger** - Logging
- **Cache** - Caching
- **Files** - Filesystem [TODO]


## Application Methods

Application provides some basic functionality via methods and by core services.

### General Accessors

- `getServices()` - Getting a service manager
- `getConfig()` - Getting an application configuration
- `getEvents()` - Getting an event manager service
- `getDebugger()` - Getting a debugger service
- `getLogger()` - Getting a logger service
- `getCache()` - Getting a cache service
- `getFiles()` - Getting a filesystem manager service [TODO]

### Application Operations

After an application was created, following methods are available

**Services**

*Registering a service into application:*

- `$app->set($service);`

*Getting a service from an application:*

- `$service = $app->get($serviceName);`
    

**Configuration**

*Getting a configuration value:*

- `$myConfig = $app->getConfig('myConfigKey', $default = null);`

*Getting a core configuration value:*

- `$myCoreConfig = $app->getCoreConfig('myCoreConfigKey', $default = null);`


**Events** 

*Binding a listener to an event:*

- `$app->bind(AppEvent::BOOTSTRAP, $listener);`
    
*Triggering an event:*
    
- `$app->emit('myEvent');`


**Caching**

TODO examples...


**Logging**

*Logging a message:*

- `$app->log('Example log message.');`


**Files** [TODO]

*Reading a file:*

- `$data = $app->file('path/to/file');`

*Writing to a file:*

- `$app->file('path/to/file', 'some file data');`

*Removing a file:*

- `$app->file()->delete('path/to/file');`

...(todo filesystem)


## HowTo

Some advanced usage.

### Dynamic Initialization

    $app = (new WebinoAppLib\Factory)->create();

TODO...


## Requirements

- PHP 5.6
- Zend\Cache
- Zend\Config
- Zend\EventManager
- Zend\Log
- Zend\ServiceManager
- Zend\Stdlib
- WebinoConfigLib
- WebinoEventLib
- WebinoExceptionLib
- TODO...


## TODO

- autoloaded configs
- filesystem `$app->getFiles() : FileSystemManager`, `$app->file() : Filesystem`, `$data = $app->file($filePath);`, `$app->file($filePath, $data);`, `$app->file()->delete($filePath)`, `$app->file()->copy($sourcePath, $targetPath)`, etc. Use http://flysystem.thephpleague.com/api/

## Addendum

This library is a part of the Webino™ platform for web applications.
