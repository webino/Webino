<? menu(USER_GUIDE, 'Event Emitter') ?>

# Event Emitter

Event Emitter allows you to bind handlers to emitted events. Events decouple various aspects of your application,
since a single event can have multiple handlers that do not depend on each other.

<?= toc() ?>

<?= todo(
'Event Handler Class',
'Event Handler Priority',
'Custom Event Emitter',
'Custom Events',
'Event Interface',
'More Examples'
) ?>


## Register Event Handler

To handle an event emit you have to register a handler to named event with the `on()` method. Then emit an event
with the `emit()` method. 

<?= example_php('EventEmitter') ?>


## Unregister Event Handler

Use the `off()` method to unregister event handlers.

<?= example_php('EventEmitter.off') ?>


## Emit Until

You can provide to the `emit()` a second argument to test each result. Returning `false` will stop an event propagation.

<?= example_php('EventEmitter.until') ?>
