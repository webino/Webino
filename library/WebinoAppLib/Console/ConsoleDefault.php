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

use Webino;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\ConsoleRoute;

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
    public function configure(ConsoleRoute $console)
    {
        $console->setType('catchall');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function showSystemBanner(ConsoleEvent $event)
    {
        $cli = $event->getCli();

        $cli
            ->br()
            ->white()->greenBg()->inline(' Webino™ ')
            ->inline(' version ')
            ->yellow()->out(Webino::VERSION)
            ->br();
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

        $routes    = $cfg->router->routes;
        $maxLen    = 0;
        $newRoutes = [];

        foreach ($routes as $route) {
            if ('catchall' === $route->type) {
                continue;
            }

            $routeLen = strlen($this->resolveRouteCommand($route->options->route));
            $routeLen > $maxLen and $maxLen = $routeLen;

            $newRoutes[$route->options->route] = $route;
        }

        $cli = $event->getCli();

        ksort($newRoutes);
        foreach ($newRoutes as $route) {

            $command = $this->resolveRouteCommand($route->options->route);
            $title = isset($route->options->defaults->title)
                ? $route->options->defaults->title
                : null;

            $cli->bold()->green()->inline($command);

            if (empty($title)) {
                $cli->br();
                continue;
            }

            $space = str_repeat(' ', $maxLen + 10 - strlen($command));
            $cli->out($space . ' - ' . $title);
        }

        $cli->br();
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
