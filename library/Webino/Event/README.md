# Webino\Event - Webino™ Event System

The boilerplate for event system.

## Quick Start

At first, create your new event handler:

```php
<?php
use Webino\Event\AbstractEventHandler;
use Webino\Event\EventInterface;

class MyEventHandler extends AbstractEventHandler
{
    public function init()
    {
        $this->on('some.event', 'onSomeEvent');
    }
    
    public function onSomeEvent(EventInterface $event, string $argOne, string $argTwo)
    {
        // do something...
    }
}
```

then attach it to the events and trigger:

```php
<?php
use Webino\Event\EventEmitter;

$emitter = new EventEmitter;
$handler = new MyEventHandler;

$handler->attachEventEmitter($emitter);

$emitter->emit('some.event', ['customArgOne', 'customArgTwo']);
```

*NOTE: Replace the `null` in the `trigger()` method with `$this` or any object you want as an event target.*

## Architecture

- Shared listeners are removed.
- Event callback argument unpacking.

## HowTo

Some advanced usage.

### Callable listener

TODO...

### Listener priority

TODO...

### Short Circuiting

TODO...

### Detaching listener

TODO...

## Requirements

- PHP 5.6
- TODO...

## TODO

 - TODO...

## Addendum

This library is a part of the Webino™ platform for web applications.
