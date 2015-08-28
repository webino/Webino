<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Context\AbstractContext;

/**
 * Class AbstractContextListener
 */
abstract class AbstractContextListener extends Listener
{
    /**
     * @return string
     */
    abstract protected function getKey();

    /**
     * @return array
     */
    public function toArray()
    {
        $cfg = parent::toArray();
        return [Config::SERVICES => $cfg[Config::SERVICES]]
            + [AbstractContext::KEY => [$this->getKey() => [Config::LISTENERS => $cfg[Config::LISTENERS]]]];
    }
}
