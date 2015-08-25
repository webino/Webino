<?php

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
