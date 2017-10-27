<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Exception;

/**
 * Class ContextEvent
 */
class ContextEvent extends AppEvent
{
    /**
     * @var \Zend\Config\Config[]
     */
    private $contexts;

    /**
     * @param AbstractApplication $app
     * @param \Zend\Config\Config[] $contexts
     */
    public function __construct(AbstractApplication $app, array $contexts)
    {
        parent::__construct(self::class);
        $this->setApp($app);
        $this->contexts = $contexts;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasContext($name)
    {
        return isset($this->contexts[$name]);
    }

    /**
     * @param string $name
     * @return string
     */
    public function getContext($name)
    {
        if (empty($this->contexts[$name])) {
            throw (new Exception\OutOfBoundsException('Context %s not set; %s'))
                ->format($name, array_keys($this->contexts));
        }

        return $this->contexts[$name];
    }
}
