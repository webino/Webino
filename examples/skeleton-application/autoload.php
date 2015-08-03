<?php

/**
 * Initialize auto-loading
 */

if (file_exists('vendor/autoload.php')) {
    return include 'vendor/autoload.php';
}

throw new RuntimeException('Unable to load. Run `php composer.phar install`.');
