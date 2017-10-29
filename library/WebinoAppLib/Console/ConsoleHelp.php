<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\ConsoleRoute;

/**
 * Class ConsoleHelp
 */
class ConsoleHelp extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(ConsoleRoute $route)
    {
        $route
            ->setPath('help [<command>]')
            ->setTitle('Show command description');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        $cfg = $event->getApp()->getConfig('console');
        if (empty($cfg->router->routes)) {
            return;
        }

        $routes = $cfg->router->routes;
        $requiredCommand = $event->getParam('command', 'help');

        // find route
        $route = null;
        foreach ($routes as $item) {
            if (!empty($item->options) && 0 === strpos($item->options->route, $requiredCommand)) {
                $route = $item;
                break;
            }
        }

        if (empty($route)) {
            // command not found
            $event->getCli()->draw('404')->br();
            return;
        }

        $title = (string) $route->options->defaults->title ?? null;
        $description = (string) $route->options->defaults->description ?? null;
        $argumentsDescription = (array) $route->options->defaults->argumentsDescription ?? [];
        $optionsDescription = (array) $route->options->defaults->optionsDescription ?? [];

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
            ->invert()->bold(" $title ")->br()
            ->yellow()->bold('Usage:')
            ->white()->blackBg(" {$route->options->route} ")->br();

        $description
            and $cli
                ->yellow()->bold('Description:')
                ->out(' ' . str_replace(PHP_EOL, PHP_EOL . ' ', $description))->br();

        $newArgumentsDescription
            and $cli
                ->yellow()->bold('Arguments:')
                ->columns($newArgumentsDescription)->br();

        $newOptionsDescription
            and $cli
                ->yellow()->bold('Options:')
                ->columns($newOptionsDescription)->br();
    }
}
