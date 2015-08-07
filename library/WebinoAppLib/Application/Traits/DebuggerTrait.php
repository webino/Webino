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
     * @return object|DebuggerInterface
     */
    public function getDebugger()
    {
        if (null === $this->debugger) {
            $this->setDebugger(new NullDebugger);
        }
        return $this->debugger;
    }

    /**
     * @param object|DebuggerInterface $debugger
     * @param bool $setService
     */
    protected function setDebugger(DebuggerInterface $debugger, $setService = true)
    {
        $this->debugger = $debugger;
        $setService and $this->setServicesService(Application::DEBUGGER, $debugger);
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
