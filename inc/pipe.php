<?php

/**
 * Asynchronous pipe
 */

if (empty($_GET['token'])) {
    return;
}

$secret   = require 'config/secret.php';
$filename = 'tmp/common/pipe_file_' . sha1($_GET['token'] . $secret);

if (file_exists($filename)) {
    // respond with pipe file contents
    echo file_get_contents($filename);
    // clear pipe file contents
    file_put_contents($filename, null);
}
