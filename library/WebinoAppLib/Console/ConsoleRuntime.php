<?php

namespace WebinoAppLib\Console;

use Psy;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\Console;

/**
 * Class ConsoleRuntime
 */
class ConsoleRuntime  extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(Console $route)
    {
        $route
            ->setRoute('console')
            ->setTitle('Run interactive PHP console');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        extract(Psy\Shell::debug([
            'app' => $event->getApp(),
            'cli' => $event->getCli(),
        ]));
    }
}
