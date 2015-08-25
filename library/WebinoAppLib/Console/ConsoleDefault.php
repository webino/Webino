<?php

namespace WebinoAppLib\Console;

use Webino;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\Console;

/**
 * Class ConsoleDefault
 */
class ConsoleDefault extends AbstractConsoleCommand
{
    /**
     * Console system banner
     */
    const BANNER = '<background_green> Webino™ </background_green> version <yellow>%s</yellow>';

    /**
     * @inheritDoc
     */
    protected function init()
    {
        parent::init();
        $this->listenConsole(ConsoleEvent::MATCH, 'showSystemBanner');
    }

    /**
     * {@inheritdoc}
     */
    public function configure(Console $console)
    {
        $console
            ->setType('catchall')
            // TODO remove, see https://github.com/zendframework/zend-mvc/issues/24
            ->setDefaults([null => null]);
    }

    /**
     * @param ConsoleEvent $event
     */
    public function showSystemBanner(ConsoleEvent $event)
    {
        $event->getCli()->br()->out(sprintf($this::BANNER, Webino::VERSION))->br();
    }

    /**
     * @param ConsoleEvent $event
     * @todo refactor
     */
    public function handle(ConsoleEvent $event)
    {
        $routes = $event->getApp()->getConfig('console')->router->routes;

        $maxLen = 0;
        $newRoutes = [];
        foreach ($routes as $route) {
            if ('catchall' === $route->type) {
                continue;
            }

            $routeLen = strlen($route->options->route);
            $routeLen > $maxLen and $maxLen = $routeLen;

            $newRoutes[$route->options->route] = $route;
        }

        ksort($newRoutes);

        foreach ($newRoutes as $route) {

            $command = $route->options->route;
            $title = isset($route->options->defaults->title)
                ? $route->options->defaults->title
                : null;

            $space = str_repeat(' ', $maxLen + 10 - strlen($command));
            $event->getCli()->out(sprintf('<green><bold>%s</bold></green>%s - %s', $command, $space, $title));
        }

        $event->getCli()->br();
    }
}
