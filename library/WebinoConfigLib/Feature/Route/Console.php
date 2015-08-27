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
     * @param string|array $route
     * @return $this
     */
    public function setRoute($route)
    {
        parent::setRoute(is_array($route) ? join(' ', $route) : $route);
        return $this;
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
     * @param string|array $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->setDefaults(['description' => is_array($description) ? join(PHP_EOL, $description) : $description]);
        return $this;
    }

    /**
     * @param array $description
     * @return $this
     */
    public function setArgumentsDescription($description)
    {
        $this->setDefaults(['argumentsDescription' => $description]);
        return $this;
    }

    /**
     * @param array $description
     * @return $this
     */
    public function setOptionsDescription($description)
    {
        $this->setDefaults(['optionsDescription' => $description]);
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
