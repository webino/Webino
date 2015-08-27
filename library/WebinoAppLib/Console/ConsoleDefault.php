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
     * @inheritDoc
     */
    protected function init()
    {
        parent::init();
        $this->listenConsole(ConsoleEvent::ROUTE_MATCH, 'showSystemBanner');
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

    public function showSystemBanner(ConsoleEvent $event)
    {
        $event->getCli()->br()->out(sprintf('<background_green> Webino™ </background_green> version <yellow>%s</yellow>', Webino::VERSION))->br();
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

            $routeLen = strlen($this->resolveRouteCommand($route->options->route));
            $routeLen > $maxLen and $maxLen = $routeLen;

            $newRoutes[$route->options->route] = $route;
        }

        ksort($newRoutes);

        foreach ($newRoutes as $route) {

            $command = $this->resolveRouteCommand($route->options->route);
            $title = isset($route->options->defaults->title)
                ? $route->options->defaults->title
                : null;

            $space = str_repeat(' ', $maxLen + 10 - strlen($command));
            $event->getCli()->out(sprintf('<green><bold>%s</bold></green>%s - %s', $command, $space, $title));
        }

        $event->getCli()->br();
    }

    /**
     * Return console route command name
     *
     * @param string $route
     * @return string
     */
    private function resolveRouteCommand($route)
    {
        $matches = [];
        preg_match('~^[a-zA-Z:_-]+~', $route, $matches);
        return current($matches);
    }
}
