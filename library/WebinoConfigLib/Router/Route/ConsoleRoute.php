<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Router\Route;

use WebinoConfigLib\Router\Route;

/**
 * Class Console
 */
class ConsoleRoute extends Route
{
    /**
     * {@inheritdoc}
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $this->setType($this::SIMPLE);
    }
}
