<?php

namespace WebinoConfigLib\Router\Route;

use WebinoConfigLib\Router\Route;

/**
 * Class Console
 */
class Console extends Route
{
    /**
     * {@inheritdoc}
     */
    public function __construct($route, $handlers = null)
    {
        parent::__construct($route, $handlers);
        $this->setType('simple');
    }
}
