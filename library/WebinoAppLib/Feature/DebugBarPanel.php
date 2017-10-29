<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application\AbstractConfig;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class DebugBarPanel
 */
class DebugBarPanel extends AbstractConfig implements
    FeatureInterface
{
    /**
     * @param string $name
     * @param string $class
     * @param string|null $factoryClass
     */
    public function __construct($name, $class, $factoryClass = null)
    {
        parent::__construct([new Service($class, $factoryClass)]);
        $this->mergeArray([DefaultDebugger::DEBUGGER => [DefaultDebugger::BAR_PANELS => [$name => $class]]]);
    }
}
