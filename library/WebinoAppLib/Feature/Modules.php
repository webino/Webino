<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Debugger\Bar\Factory\ModulesPanelFactory;
use WebinoAppLib\Debugger\Bar\ModulesPanel;
use WebinoAppLib\Factory\ModulesFactory;
use WebinoAppLib\Listener\ModulesListener;
use WebinoAppLib\Service\Modules as ModulesService;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class Modules
 */
class Modules extends Config implements
    FeatureInterface
{
    /**
     * Modules list config key
     */
    const MODULES = 'modules';

    /**
     * Configure an application modules
     *
     * @param array $modules
     */
    public function __construct(array $modules)
    {
        $this->mergeArray([$this::MODULES => $modules]);

        parent::__construct([
            new CoreService(ModulesService::class, ModulesFactory::class),
            new CoreListener(ModulesListener::class),
            new DebugBarPanel(ModulesPanel::NAME, ModulesPanel::class, ModulesPanelFactory::class),
        ]);
    }
}
