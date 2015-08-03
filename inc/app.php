<?php

use WebinoAppLib\Event\AppEvent;

/** @var \WebinoAppLib\Application\BaseApplicationInterface $appCore */
$appCore = require __DIR__ . '/core.php';
if (empty($appCore)) {
    trigger_error('Expected application core', E_USER_ERROR);
}

/**
 * Application bootstrap script
 */
require 'bootstrap.php';

// bootstrap application
return $appCore->bootstrap();
