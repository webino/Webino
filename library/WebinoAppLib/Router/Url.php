<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Router;

use WebinoHtmlLib\Html;
use Zend\Mvc\Router\RouteStackInterface;

/**
 * Class Url
 */
final class Url implements UrlInterface
{
    /**
     * @var RouteStackInterface
     */
    private $router;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @var array
     */
    private $options = [];

    /**
     * @param RouteStackInterface $router
     * @param array $params
     * @param array $options
     */
    public function __construct(RouteStackInterface $router, array $params, array $options)
    {
        $this->router  = $router;
        $this->params  = $params;
        $this->options = $options;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function html($label = '')
    {
        return new Html\Url($this->__toString(), $label);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->router->assemble($this->params, $this->options);
    }
}
