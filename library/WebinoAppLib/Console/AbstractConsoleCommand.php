<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Feature\ConsoleListener;
use WebinoAppLib\Listener\Console\ConsoleListenerTrait;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoConfigLib\Feature\Route\ConsoleRoute;
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
     * @param ConsoleRoute $console
     */
    abstract public function configure(ConsoleRoute $console);

    /**
     * @param ConsoleEvent $event
     */
    abstract public function handle(ConsoleEvent $event);

    /**
     * @return ConsoleRoute
     */
    private function createRoute()
    {
        $route = new ConsoleRoute(static::class);
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
