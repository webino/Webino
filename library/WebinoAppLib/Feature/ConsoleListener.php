<?php

namespace WebinoAppLib\Feature;

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
        return 'console';
    }
}
