<?php

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
     * @param string|null $var Variable.
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
}
