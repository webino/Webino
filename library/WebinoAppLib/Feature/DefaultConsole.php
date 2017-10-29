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
use WebinoAppLib\Console;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature;
use WebinoAppLib\Service\Console as ConsoleService;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class DefaultConsole
 */
class DefaultConsole extends AbstractConfig implements
    FeatureInterface
{
    /**
     * Application config key
     */
    const KEY = 'console';

    /**
     * Register Console config feature
     */
    public function __construct()
    {
        parent::__construct([
            new Feature\CoreService(ConsoleService::class, Factory\ConsoleFactory::class),

            new Console\ConsoleDefault,
            new Console\ConsoleHelp,
            new Console\ConsoleShell,
            new Console\ConsoleVersion,
            new Console\ConsoleCredits,
        ]);
    }
}
