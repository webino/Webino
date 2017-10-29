<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Cache;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Filesystem
 */
class Filesystem extends AbstractConfig
{
    /**
     * @param string $namespace
     * @param string|null $dir
     */
    public function __construct($namespace, $dir = null)
    {
        $this->mergeArray([
            'adapter' => [
                'name' => 'filesystem',
                'options' => [
                    'namespace'       => $namespace,
                    'cacheDir'       => is_null($dir) ? 'data/cache' : $dir,
                    'dirPermission'  => false,
                    'filePermission' => false,
                    'umask'           => 7,
                ],
            ],
            'plugins' => ['serializer'],
        ]);
    }
}
