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

        $requiredCommand = $event->getParam('command');

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

        $argumentsDescription = isset($route->options->defaults->argumentsDescription)
            ? $route->options->defaults->argumentsDescription
            : [];
        
        $optionsDescription = isset($route->options->defaults->optionsDescription)
            ? $route->options->defaults->optionsDescription
            : [];

        $newArgumentsDescription = [];
        foreach ($argumentsDescription as $key => $value) {
            $newArgumentsDescription[" <green>$key</green>"] = '- ' . $value;
        }

        $newOptionsDescription = [];
        foreach ($optionsDescription as $key => $value) {
            $newOptionsDescription[" <green>--$key</green>"] = '- ' . $value;
        }

        $cli = $event->getCli();

        $cli
            ->invert(" $title ")->br()
            ->yellowBold('Usage:')
            ->backgroundBlack($route->options->route)->br();

        empty($description)
            or $cli->yellowBold('Description:')->out(' ' . str_replace(PHP_EOL, PHP_EOL . ' ', $description))->br();

        empty($argumentsDescription)
            or $cli->yellowBold('Arguments:')->columns($newArgumentsDescription)->br();

        empty($argumentsDescription)
            or $cli->yellowBold('Options:')->columns($newOptionsDescription)->br();
    }
}
