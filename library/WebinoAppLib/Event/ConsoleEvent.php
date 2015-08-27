<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Service\Console;
use WebinoAppLib\Util\ConsoleEventNameResolver;

/**
 * Class ConsoleEvent
 */
class ConsoleEvent extends AbstractRouteEvent
{
    /**
     * Route event prefix
     */
    const PREFIX = 'console.';

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = call_user_func(ConsoleEventNameResolver::getInstance(), $name);
        return $this;
    }

    /**
     * @return Console
     */
    public function getCli()
    {
        return $this->getApp()->get(Console::class);
    }
}
