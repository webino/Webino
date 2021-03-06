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

use Webino;
use WebinoAppLib\Application\AbstractConfig;
use WebinoAppLib\Debugger\Bar\ConfigPanel;
use WebinoAppLib\Debugger\Bar\Factory\ConfigPanelFactory;
use WebinoAppLib\Listener\DebuggerListener;
use WebinoConfigLib\Feature\FeatureInterface;
use Zend\Version\Version as ZendFramework;

/**
 * Class DefaultDebugger
 */
class DefaultDebugger extends AbstractConfig implements
    FeatureInterface
{
    /**
     * Debugger config key
     */
    const DEBUGGER = 'debugger';

    /**
     * Debugger bar info config key
     */
    const INFO = 'info';

    /**
     * Debugger bar panels config key
     */
    const BAR_PANELS = 'barPanels';

    /**
     * Register Debugger config feature
     */
    public function __construct()
    {
        parent::__construct([
            new Listener(DebuggerListener::class),
            new DebugBarPanel(ConfigPanel::NAME, ConfigPanel::class, ConfigPanelFactory::class),

            new DebugBarInfo([
                'Webino™' => Webino::VERSION,
                'Zend Framework' => ZendFramework::VERSION,
            ]),
        ]);
    }
}
