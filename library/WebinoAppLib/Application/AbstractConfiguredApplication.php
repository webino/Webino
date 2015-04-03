<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Event\AppEvent;

/**
 * Class AbstractConfiguredApplication
 */
abstract class AbstractConfiguredApplication extends AbstractBaseApplication implements
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
