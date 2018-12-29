<?php

use Tracy\Debugger;

/**
 * Alias for var_dump()
 *
 * @param mixed $subject
 */
function d($subject): void
{
    var_dump($subject);
}

/**
 * Dying var_dump()
 *
 * Terminates execution.
 *
 * @param mixed $subject
 */
function dd($subject): void
{
    var_dump($subject);
    exit;
}

/**
 * Alias for print_r() scream
 *
 * @param mixed $subject
 */
function p($subject): void
{
    if (class_exists(Debugger::class)) {
        Debugger::dump($subject);
        return;
    }

    print_r($subject);
}

/**
 * Dying print_r() scream
 *
 * Terminates execution.
 *
 * @param mixed $subject
 */
function pd($subject): void
{
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
function pr($subject): string
{
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
function bd($subject): void
{
    if (class_exists(Debugger::class)) {
        Debugger::barDump($subject);
    }
}

/**
 * Web debugger break point
 *
 * Sometimes is useful by throwing an exception to check a backtrace.
 *
 * @param string $msg
 */
function e(string $msg = ''): void
{
    throw new \Webino\DevelopmentException($msg);
}
