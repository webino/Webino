<?php

namespace WebinoConfigLib\Router\Route;

use WebinoConfigLib\Router\AbstractRoute;

/**
 * Class Regex
 */
class Regex extends AbstractRoute implements Regex\RouteConstructorInterface
{
    use Regex\RouteConstructorTrait;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->setType('regex');
        $this->hasRoute() and $this->getData()->options['regex'] = $this->getRoute();
        $this->hasSpec()  and $this->getData()->options['spec']  = $this->getSpec();
    }
}
