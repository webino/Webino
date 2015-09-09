<?php

namespace WebinoAppLib\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Feature\ConsoleListener;
use WebinoAppLib\Listener\Console\ConsoleListenerTrait;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoConfigLib\Feature\Route\Console;
use WebinoEventLib\ListenerAggregateTrait;
use Zend\EventManager\ListenerAggregateInterface;

/**
 * Class AbstractConsoleCommand
 */
abstract class AbstractConsoleCommand implements
    ConsoleRouteInterface,
    FeatureInterface,
    ListenerAggregateInterface
{
    use ConsoleListenerTrait;
    use ListenerAggregateTrait;

    /**
     * @param Console $console
     */
    abstract public function configure(Console $console);

    /**
     * @param ConsoleEvent $event
     */
    abstract public function handle(ConsoleEvent $event);

    /**
     * @return Console
     */
    private function createRoute()
    {
        $route = new Console(static::class);
        $this->configure($route);
        return $route;
    }

    /**
     * Initialize listener
     */
    protected function init()
    {
        $this->listenConsole(static::class, 'handle');
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return (new ConsoleListener(static::class))->toArray() + $this->createRoute()->toArray();
    }
}
