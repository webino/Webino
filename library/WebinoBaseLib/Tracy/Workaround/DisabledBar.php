<?php

namespace WebinoBaseLib\Tracy\Workaround;

/**
 * Disabled tracy debug bar
 *
 * @todo issue https://github.com/nette/tracy/issues/73
 */
class DisabledBar
{
    /**
     * @var array
     */
    public $info = [];

    /**
     *
     */
    public function addPanel()
    {
    }

    /**
     *
     */
    public function getPanel()
    {
    }

    /**
     *
     */
    public function render()
    {
    }
}
