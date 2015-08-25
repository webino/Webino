<?php

namespace WebinoConfigLib\Feature\Route;

use WebinoConfigLib\Feature\Route as BaseRoute;

/**
 * Class Console
 */
class Console extends BaseRoute
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
     * Set route title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->setDefaults(['title' => (string) $title]);
        return $this;
    }

    /**
     * Set route description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->setDefaults(['description' => (string) $description]);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return ['console' => parent::toArray()];
    }
}
