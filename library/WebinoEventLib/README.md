# WebinoEventLib - Webino™ Event System Library

The boilerplate for Zend Framework 2 event system.

## QuickUse

At first, create your new listener:

    <?php
    
    use WebinoEventLib\AbstractListener;
    use WebinoEventLib\Event;
    
    class MyListener extends AbstractListener
    {
        public function init()
        {
            $this->listen('someEvent', 'onSomeEvent');
        }
        
        public function onSomeEvent(Event $event, $customArgOne, $customArgTwo)
        {
            // do something...
        }
    }
    
then attach it to the events and trigger:

    use WebinoEventLib\EventManager;

    $events = new EventManager;

    $events->attach(new MyListener);
    
    $events->trigger('someEvent', null, [$customArgOne, $customArgTwo]);

    
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
