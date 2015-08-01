<?php

use Tester\Assert;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature\CoreListener;
use WebinoAppLib\Feature\Listener;
use WebinoEventLib\AbstractListener;
use WebinoEventLib\Event;
use Zend\Stdlib\CallbackHandler;

require __DIR__ . '/../bootstrap.php';


class MyTestEventListener
{
    public static $invoked = 0;

    public function __invoke()
    {
        static::$invoked++;
    }
}

class MyTestEventListenerObject extends MyTestEventListener
{
    public static $invoked = 0;
}

class MyTestAggregateEventListener extends AbstractListener
{
    const EVENT = 'aggregateTestEvent';

    public static $triggered = 0;

    public function init()
    {
        $this->listen($this::EVENT, 'onTestEvent');
    }

    public function onTestEvent()
    {
        static::$triggered++;
    }
}

class MyTestAggregateEventListenerObject extends MyTestAggregateEventListener
{
    const EVENT = 'aggregateObjectTestEvent';

    public static $triggered = 0;
}

class MyCoreListener extends AbstractListener
{
    public static $configured = false;
    public static $bootstrapped = false;
    public static $dispatched = false;

    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(AppEvent::CONFIGURE, 'onConfig');
        $this->listen(AppEvent::BOOTSTRAP, 'onBootstrap');
        $this->listen(AppEvent::DISPATCH, 'onDispatch');
    }

    public function onConfig()
    {
        static::$configured = true;
    }

    public function onBootstrap()
    {
        static::$bootstrapped = true;
    }

    public function onDispatch()
    {
        static::$dispatched = true;
    }
}

class MyListener extends AbstractListener
{
    public static $bootstrapped = false;
    public static $dispatched = false;

    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(AppEvent::BOOTSTRAP, 'onBootstrap');
        $this->listen(AppEvent::DISPATCH, 'onDispatch');
    }

    public function onBootstrap()
    {
        static::$bootstrapped = true;
    }

    public function onDispatch()
    {
        static::$dispatched = true;
    }
}

class MyInvokableListener
{
    public function __invoke(Event $event)
    {
        // do something...
    }
}


$config = new CoreConfig([
    new CoreListener(MyCoreListener::class),
    new Listener(MyListener::class),
]);


$app = (new Factory)->create($config)->bootstrap();

// --- Closure listener

$closureListenerTriggered = 0;
$closureListenerArgOne = 'closureListenerArgOne';

$closureListener = function (Event $event, $closureListenerArgOne = null) use (&$closureListenerTriggered) {
    if (null !== $closureListenerArgOne
        && 'closureListenerArgOne' !== $closureListenerArgOne
    ) {
        throw new \LogicException('Expected closure listener argument');
    }

    $closureListenerTriggered++;
};

$closureListenerCallbackTriggered = 0;

$closureListenerCallback = function () use (&$closureListenerCallbackTriggered) {
    $closureListenerCallbackTriggered++;
};

$app->bind('myClosureEvent', $closureListener);

$app->emit('myClosureEvent', $closureListenerCallback);

$app->emit('myClosureEvent', ['closureListenerArgOne'], $closureListenerCallback);

Assert::exception(function () use ($app) {
    $app->emit('myClosureEvent', ['invalidClosureListenerArgOne']);
}, \LogicException::class, 'Expected closure listener argument');

$app->unbind('myClosureEvent', $closureListener);

$app->emit('myClosureEvent', ['closureListenerArgOne']);

$closureEventObject = new Event('myClosureEventObject');

$app->bind($closureEventObject->getName(), $closureListener);

$app->emit($closureEventObject);

// --- Callback handler

$callbackHandlerTriggered = 0;

$callbackHandler = new CallbackHandler(
    function () use (&$callbackHandlerTriggered) {
        $callbackHandlerTriggered++;
    },
    [
        'event'    => 'myCallbackEvent',
        'priority' => AppEvent::BEGIN,
    ]
);

$app->bind($callbackHandler);

$app->emit('myCallbackEvent');

$app->unbind($callbackHandler);

$app->emit('myCallbackEvent');

// --- Invokable listener

$app->bind('myInvokableEvent', MyTestEventListener::class);

$app->emit('myInvokableEvent');

$app->unbind('myInvokableEvent', MyTestEventListener::class);

$app->emit('myInvokableEvent');

$testEventListener = new MyTestEventListenerObject;

$app->bind('myInvokableObjectEvent', $testEventListener);

$app->emit('myInvokableObjectEvent');

$app->unbind('myInvokableObjectEvent', $testEventListener);

$app->emit('myInvokableObjectEvent');

// --- Listener aggregate

$app->bind(MyTestAggregateEventListener::class);

$app->emit(MyTestAggregateEventListener::EVENT);

$app->unbind(MyTestAggregateEventListener::class);

$app->emit(MyTestAggregateEventListener::EVENT);

$testAggregateListener = new MyTestAggregateEventListenerObject;

$app->bind($testAggregateListener);

$app->emit(MyTestAggregateEventListenerObject::EVENT);

$app->unbind($testAggregateListener);

$app->emit(MyTestAggregateEventListenerObject::EVENT);

// ---

$app->dispatch();


Assert::true(MyCoreListener::$configured);

Assert::true(MyCoreListener::$bootstrapped);

Assert::true(MyCoreListener::$dispatched);

Assert::true(MyListener::$bootstrapped);

Assert::true(MyListener::$dispatched);

Assert::same(3, $closureListenerTriggered);

Assert::same(2, $closureListenerCallbackTriggered);

Assert::same(1, $callbackHandlerTriggered);

Assert::same(1, MyTestEventListener::$invoked);

Assert::same(1, MyTestEventListenerObject::$invoked);

Assert::same(1, MyTestAggregateEventListener::$triggered);

Assert::same(1, MyTestAggregateEventListenerObject::$triggered);
