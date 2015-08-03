<?php

/**
 * Public entry point
 */

// go to parent directory
chdir(dirname(__DIR__));

// server dispatch lock
if ('cli' !== PHP_SAPI) {
    while (file_exists('tmp/common/dispatch.lock')) {
        usleep(1);
    }
};

/**
 * Application auto-loader
 */
require 'autoload.php';

/**
 * Application index file
 */
require WebinoAppLib\Includes\Index::FILE;
