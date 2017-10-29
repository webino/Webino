<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature\Route;

use WebinoConfigLib\Feature\Route as BaseRoute;

/**
 * Class Console
 */
class ConsoleRoute extends BaseRoute
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
    public function setPath($path)
    {
        parent::setPath(is_array($path) ? join(' ', $path) : $path);
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
        is_array($description)
            and $description = join(PHP_EOL, $description) ;

        $this->setDefaults(['description' => $description]);
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
