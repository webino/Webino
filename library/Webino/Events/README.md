# Webino\Events - Webino™ Event System

The boilerplate for event system.

## Quick Start

At first, create your new event handler:

```php
<?php
use Webino\Events\AbstractEventHandler;
use Webino\Events\EventEmitter;
use Webino\Events\EventInterface;

class MyEventHandler extends AbstractEventHandler
{
    public function initEvents() : void
    {
        $this->on('some.event', 'onSomeEvent');
    }
    
    public function onSomeEvent(EventInterface $event, string $argOne, string $argTwo) : void
    {
        // set custom event values like following
        $event['foo'] = 'bar';
    }
}
```

then attach it to the events and emit:

```php
<?php

$emitter = new EventEmitter;
$handler = new MyEventHandler;

$emitter->on($handler);

$event = $emitter->emit('some.event', ['customArgOne', 'customArgTwo']);
```

```php
<?php
// get custom event value
$event['foo'];

// get event value or default
$event->getValue('foo', 'default');

// get event responses
$event->getResponses();

// check if event propagation was stopped
$event->isPropagationStopped();
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
