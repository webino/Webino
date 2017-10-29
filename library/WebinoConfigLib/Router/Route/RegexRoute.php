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

use WebinoConfigLib\Router\AbstractRoute;

/**
 * Class Regex
 */
class RegexRoute extends AbstractRoute implements Regex\RouteConstructorInterface
{
    use Regex\RouteConstructorTrait;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->hasPath() and $this->getData()->options['regex'] = $this->getPath();
        $this->hasSpec() and $this->getData()->options['spec']  = $this->getSpec();
    }
}
