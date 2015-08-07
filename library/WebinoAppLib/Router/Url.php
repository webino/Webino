<?php

namespace WebinoAppLib\Router;

use WebinoBaseLib\Html\UrlHtml;
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
    public function __construct($router, array $params, array $options)
    {
        $this->router  = $router;
        $this->params  = $params;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function html($label = '')
    {
        return new UrlHtml($this->__toString(), $label);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->router->assemble($this->params, $this->options);
    }
}
