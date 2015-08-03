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
    public function __construct($route)
    {
        parent::__construct($route);
        $this->setType($this::SIMPLE);
    }
}
