<?php
/**
 * Basic usage example application index
 */

require 'vendor/autoload.php';

$app = Webino::application()->bootstrap();
$app->dispatch();
