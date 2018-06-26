<?php

namespace Webino;

/**
 * Class AbstractApp
 */
abstract class AbstractApp implements AppInterface
{
    use AppEventEmitterTrait;
    use ServiceContainerTrait;

    /**
     * {@inheritdoc}
     */
    public function bootstrap()
    {
        try {
            $event = new Event\BootstrapEvent;
            $this->emit($event);
            $this->off(null, $event);
        } catch (\Throwable $exc) {
            $this->dispatchError($exc);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch()
    {
        $this->bootstrap();

        try {
            $event = new Event\DispatchEvent;
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
        $event = new Event\DispatchErrorEvent;
        $event->setException($exc);
        $this->emit($event);
        $this->off(null, $event);
    }
}
