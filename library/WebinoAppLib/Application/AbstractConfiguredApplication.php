<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Event\DispatchEvent;

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
        $this->emit(new DispatchEvent($this));
    }
}
