<?php

namespace WebinoAppLib\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\Console;

/**
 * Class ConsoleHelp
 */
class ConsoleHelp extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(Console $console)
    {
        $console
            ->setRoute('help <command>')
            ->setTitle('Show command description');
    }

    /**
     * @param ConsoleEvent $event
     * @todo refactor
     */
    public function handle(ConsoleEvent $event)
    {
        $routes = $event->getApp()->getConfig('console')->router->routes;

        $requiredCommand = $event->getArgument('command');

        // find route
        foreach ($routes as $route) {
            if (0 === strpos($route->options->route, $requiredCommand)) {
                break;
            }
        }

        if (empty($route)) {
            // TODO command not found
            return;
        }

        $title = isset($route->options->defaults->title)
            ? $route->options->defaults->title
            : null;

        $description = isset($route->options->defaults->description)
            ? $route->options->defaults->description
            : null;

        $cli = $event->getCli();

        $cli
            ->out('<bold>' . $title . '</bold>')
            ->green('Usage:')
            ->backgroundBlack(' php index.php ' . $route->options->route . ' ');

        empty($description)
            or $cli->green('Description:')->out($description);

        $cli->br();
    }
}
