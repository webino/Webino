<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Service\DebuggerInterface;
use WebinoAppLib\Service\NullDebugger;

/**
 * Trait Debugger
 */
trait DebuggerTrait
{
    /**
     * @var DebuggerInterface
     */
    private $debugger;

    /**
     * @param string $name
     * @param mixed $service
     */
    abstract protected function setServicesService($name, $service);

    /**
     * Set optional service from services into application
     *
     * @param string $service Service name
     */
    abstract protected function optionalService($service);

    /**
     * @return object|DebuggerInterface
     */
    public function getDebugger()
    {
        if (null === $this->debugger) {
            $this->optionalService(Application::DEBUGGER);
            if (null === $this->debugger) {
                $this->setDebugger(new NullDebugger);
            }
            $this->setServicesService(Application::DEBUGGER, $this->debugger);
        }
        return $this->debugger;
    }

    /**
     * @param object|DebuggerInterface $debugger
     */
    protected function setDebugger(DebuggerInterface $debugger)
    {
        $this->debugger = $debugger;
    }

    /**
     * Debug a variable
     *
     * @param mixed|null $var Variable to dump, or null to return debugger.
     * @param bool|false $return Return variable dump as string.
     * @return mixed|\WebinoAppLib\Debugger\DebuggingInterface
     */
    public function debug($var = null, $return = false)
    {
        if (null === $var) {
            return $this->getDebugger();
        }
        return $this->getDebugger()->dump($var, $return);
    }

    /**
     * Returns variable dump
     *
     * @param mixed $var
     * @return mixed|\WebinoAppLib\Debugger\DebuggingInterface
     */
    public function debugR($var)
    {
        return $this->debug($var, true);
    }
}
