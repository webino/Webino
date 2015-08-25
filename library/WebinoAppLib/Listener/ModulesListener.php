<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Feature\Modules as ModulesFeature;
use WebinoAppLib\Service\Modules;
use WebinoEventLib\AbstractListener;

/**
 * Class ModulesListener
 */
class ModulesListener extends AbstractListener
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->listen(AppEvent::BOOTSTRAP, 'loadModules', AppEvent::BEFORE);
    }

    /**
     * @param AppEvent $event
     */
    public function loadModules(AppEvent $event)
    {
        $app = $event->getApp();
        $cfg = $app->getConfig();

        /** @var Modules $modules */
        $modules = $app->get(Modules::class);
        $modules->loadModules($cfg->get(ModulesFeature::MODULES)->toArray());
    }
}
