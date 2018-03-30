<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config\Cache;

use Webino\Config\AbstractConfig;

/**
 * Class Memory
 */
class Memory extends AbstractConfig
{
    /**
     * @param string $namespace
     * @param int|null $limit
     */
    public function __construct(string $namespace, int $limit = null)
    {
        $this->mergeArray([
            'adapter' => [
                'name' => 'memory',
                'options' => [
                    'namespace'   => $namespace,
                    'memoryLimit' => $limit,
                ],
            ],
        ]);
    }
}
