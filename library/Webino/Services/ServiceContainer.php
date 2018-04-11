<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Services;

/**
 * Class ServiceContainer
 */
class ServiceContainer implements ServiceContainerInterface
{
    use ServiceContainerTrait;

    /**
     * @param array $config Service container configuration
     */
    public function __construct(array $config = [])
    {
        $this->configure($config);
    }
}
