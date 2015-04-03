<?php

namespace WebinoConfigLib\Feature\Route;

use WebinoConfigLib\Feature\Route;

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

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return ['console' => parent::toArray()];
    }
}
