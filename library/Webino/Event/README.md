# Webino\Event - Webino™ Event System

The boilerplate for event system.

## Quick Start

At first, create your new event handler:

```php
<?php
use Webino\Event\AbstractEventHandler;
use Webino\Event\EventEmitter;
use Webino\Event\EventInterface;

class MyEventHandler extends AbstractEventHandler
{
    public function initEvents() : void
    {
        $this->on('some.event', 'onSomeEvent');
    }
    
    public function onSomeEvent(EventInterface $event, string $argOne, string $argTwo) : void
    {
        // do something...
    }
}
```

then attach it to the events and emit:

```php
<?php

$emitter = new EventEmitter;
$handler = new MyEventHandler;

$emitter->on($handler);

$emitter->emit('some.event', ['customArgOne', 'customArgTwo']);
```

### Callable listener

TODO...

### Listener priority

TODO...

### Short Circuiting

TODO...

### Detaching listener

TODO...

## Requirements

- PHP 7.2
- TODO...

## TODO

 - TODO...

## Addendum

This library is a part of the Webino™ boilerplate for web applications.
