<?php
/**
 * Webino (http://webino.sk/)
 *
 * Useful development functions.
 *
 * @link        https://github.com/webino/WebinoDevLib/ for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk/)
 * @license     BSD-3-Clause
 */

use Tracy\Debugger;

/**
 * Alias for var_dump()
 *
 * @param mixed $subject
 */
function d($subject) {
    var_dump($subject);
}

/**
 * Diyng var_dump()
 *
 * @param mixed $subject
 */
function dd($subject) {
    var_dump($subject);
    exit;
}

/**
 * Alias for print_r() scream
 *
 * @param mixed $subject
 */
function p($subject) {
    if (class_exists(Debugger::class)) {
        Debugger::dump($subject);
        return;
    }
    print_r($subject);
}

/**
 * Dying print_r() scream
 *
 * @param mixed $subject
 */
function pd($subject) {
    if (class_exists(Debugger::class)) {
        Debugger::dump($subject);
        exit;
    }
    print_r($subject);
    exit;
}

/**
 * Alias for print_r() return
 *
 * @param mixed $subject
 * @return string
 */
function pr($subject) {
    if (class_exists(Debugger::class)) {
        return Debugger::dump($subject, true);
    }
    return print_r($subject, true);
}

/**
 * Debugger bar dump
 *
 * @param mixed $subject
 */
function bd($subject) {
    if (class_exists(Debugger::class)) {
        Debugger::barDump($subject);
    }
}

/**
 * Web debugger break point
 *
 * Sometimes is useful by throwing an exception to check a backtrace.
 *
 * @link https://github.com/webino/WebinoDebugLib Web debugger
 * @param string $msg
 */
function e($msg = '') {
    throw new \WebinoDevLib\Exception\DevelopmentException($msg);
}

/**
 * For testing purposes only
 *
 * User Acceptance Testing
 *
 * @return bool
 */
function isUat()
{
    return file_exists('tmp/common/uat.lock');
}
