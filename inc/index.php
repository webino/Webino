<?php

/**
 * Application index
 */

/** @var \WebinoAppLib\Application\ConfiguredApplicationInterface $app */
$app = require __DIR__ . '/app.php';
if (empty($app)) {
    trigger_error('Expected bootstrapped application', E_USER_ERROR);
}

/**
 * Application dispatch script
 */
require 'dispatch.php';

// dispatch application
$app->dispatch();
