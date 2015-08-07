<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application\AbstractConfig;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class DebugBarInfo
 */
class DebugBarInfo extends AbstractConfig implements
    FeatureInterface
{
    /**
     * @param array $info
     */
    public function __construct(array $info)
    {
        parent::__construct([[Debugger::DEBUGGER => [Debugger::INFO => $info]]]);
    }
}
