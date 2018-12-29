<?php
/**
 * Webino™
 *
 * @copyright Copyright (c) 2012-2018 Webino, s.r.o. (http://webino.sk)
 * @author    Peter Bačinský <peter@bacinsky.sk> (http://bacinsky.sk)
 */

chdir(__DIR__);
Phar::mapPhar(basename(__FILE__));
$src = 'phar://' . __FILE__;
set_include_path($src . PATH_SEPARATOR . get_include_path());
empty($loader) and require_once 'vendor/autoload.php';
__HALT_COMPILER();
