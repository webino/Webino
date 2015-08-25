<?php

namespace WebinoAppLib\Console;

use Webino;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\Console;

/**
 * Class ConsoleVersion
 */
class ConsoleVersion extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(Console $console)
    {
        $console
            ->setRoute('version')
            ->setTitle('Show script version');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        $event->getCli()->out(Webino::VERSION);
    }
}
