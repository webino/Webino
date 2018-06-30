<?php

require __DIR__ . '/../../vendor/autoload.php';

Tester\Environment::setup();


/**
 * Examples test helper
 *
 * @param string $dir
 * @param callable $callback
 * @return void
 */
function examplesTest(string $dir, callable $callback): void
{
    // setup examples test
    $pattern = $dir . '/../../examples/*.php';
    $bootstrap = ini_get('auto_prepend_file');
    $bootstrap = dirname($bootstrap) . '/../../vendor/autoload.php';

    // test examples
    $results = [];
    foreach (glob($pattern) as $path) {
        $result = null;
        passthru("php -dauto_prepend_file=$bootstrap " . $path, $result);
        $results[] = $result;
    }

    foreach ($results as $result) {
        $callback($result);
    }
}
