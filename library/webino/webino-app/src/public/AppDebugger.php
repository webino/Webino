<?php

namespace Webino;

use Tracy\Debugger;

/**
 * Class AppDebugger
 * @package webino-app
 */
class AppDebugger extends Debugger
{
    /**
     * {@inheritdoc}
     */
    public static function enable($mode = null, $logDirectory = null, $email = null)
    {
        $logDirectory or $logDirectory = realpath('.') . '/../log';
        ini_set('error_log', "$logDirectory/php.log");
        parent::enable($mode, $logDirectory, $email);
    }
}
