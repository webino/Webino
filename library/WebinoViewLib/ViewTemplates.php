<?php

namespace WebinoViewLib;

use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\SplStack;

/**
 * Class ViewTemplates
 */
class ViewTemplates extends AbstractOptions
{
    /**
     * @var array
     */
    private $map = [];

    /**
     * @return array
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param array $map
     * @return $this
     */
    public function setMap(array $map)
    {
        $this->map = $map;
        return $this;
    }

    public function resolve($name)
    {
        // TODO isset?
        $target = $this->map[$name];

        // TODO resolvers

        // TODO constant
        if (0 === strpos($target, 'file://')) {
            return file_get_contents($target);
        }

        return $target;
    }
}
