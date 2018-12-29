<?php

namespace Webino;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class AppLogger
 * @package webino-app
 */
class AppLogger extends Logger
{
    /**
     * Log file path
     */
    const FILE = 'log://app.log';

    /**
     * @param CreateServiceEvent $event
     * @return AppLogger
     */
    static function create(CreateServiceEvent $event): AppLogger
    {
        $app = $event->getApp();
        $filePath = $app->getFile(static::FILE)->getRealPath();

        // TODO configurable app logger handlers
        $handlers = [];
        try {
            $handlers[] = new StreamHandler($filePath);
        } catch (\Throwable $exc) {
            trigger_error($exc->getMessage(), E_USER_ERROR);
        }

        return new static(static::class, $handlers);
    }
}
