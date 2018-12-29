<?php

namespace Webino;

/**
 * Class AbstractApp
 * @package webino-app
 */
abstract class AbstractApp extends \ArrayObject implements AppInterface
{
    use LoggerTrait;
    use AppEventEmitterTrait;
    use InstanceContainerTrait;
    use FilesystemTrait;
    use ServiceContainerTrait;
    use CustomInstanceContainerTrait;

    /**
     * Application constructor
     */
    function __construct()
    {
        parent::__construct([]);
    }

    /**
     * Set application state
     *
     * @param iterable $state
     */
    function setState(iterable $state): void
    {
        foreach ($state as $key => $value) {
            $this[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    function bootstrap()
    {
        try {
            $event = new BootstrapEvent;
            $this->emit($event);
            $this->off(null, $event);
        } catch (\Throwable $exc) {
            $this->dispatchError($exc);
        }
    }

    /**
     * {@inheritdoc}
     */
    function dispatch()
    {
        $this->bootstrap();

        try {
            $event = new DispatchEvent;
            $this->emit($event);
            $this->off(null, $event);
        } catch (\Throwable $exc) {
            $this->dispatchError($exc);
        }
    }

    /**
     * @param \Throwable $exc
     */
    protected function dispatchError(\Throwable $exc)
    {
        $event = new DispatchErrorEvent;
        $event->setException($exc);
        $this->emit($event);
        $this->off(null, $event);
    }
}
