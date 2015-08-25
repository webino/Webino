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
     * @param string|array $info
     * @param string|null $value
     */
    public function __construct($info, $value = null)
    {
        $_info = is_string($info) ? $info = [$info => (string) $value] : (array) $info;
        parent::__construct([[DefaultDebugger::DEBUGGER => [DefaultDebugger::INFO => $_info]]]);
    }
}
