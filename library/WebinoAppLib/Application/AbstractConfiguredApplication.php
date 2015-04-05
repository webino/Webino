<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Event\AppEvent;

/**
 * Class AbstractConfiguredApplication
 */
class AbstractConfiguredApplication extends AbstractApplication implements
    ConfiguredApplicationInterface
{
    /**
     * {@inheritdoc}
     */
    public function dispatch()
    {
        $this->emit(AppEvent::DISPATCH);
    }
}
