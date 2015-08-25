<?php

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
     * Register Console config feature
     */
    public function __construct()
    {
        parent::__construct([
            new Feature\CoreService(ConsoleService::class, Factory\ConsoleFactory::class),

            new Console\ConsoleDefault,
            new Console\ConsoleHelp,
            new Console\ConsoleRuntime,
            new Console\ConsoleVersion,
        ]);
    }
}
