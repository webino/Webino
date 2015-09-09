<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Context\ConsoleContext;

/**
 * Class ConsoleListener
 */
class ConsoleListener extends AbstractContextListener
{
    /**
     * @return string
     */
    protected function getKey()
    {
        return ConsoleContext::class;
    }
}
