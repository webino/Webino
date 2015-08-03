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
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->setType($this::SIMPLE);
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return ['console' => parent::toArray()];
    }
}
