<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Context\AbstractContext;
use WebinoAppLib\Context\ContextInterface;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\ContextEvent;
use WebinoAppLib\Exception\DomainException;
use WebinoAppLib\Log;
use WebinoEventLib\AbstractListener;

/**
 * Class ContextListener
 */
class ContextListener extends AbstractListener
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->listen(AppEvent::BOOTSTRAP, 'setupContext', AppEvent::BEFORE);
    }

    /**
     * @param AppEvent $event
     * @return void
     */
    public function setupContext(AppEvent $event)
    {
        $app = $event->getApp();
        $cfg = $app->getConfig()->get(AbstractContext::CONTEXT);

        if (null === $cfg) {
            return;
        }

        $contexts = [];

        /** @var \WebinoAppLib\Application\Config $context */
        foreach ($cfg as $key => $context) {
            if (empty($context->class)) {
                $app->log(Log\ContextDisabled::class, [$key]);
                continue;
            }

            $obj = new $context->class;
            if (!($obj instanceof ContextInterface)) {
                throw (new DomainException('Expected content of type %s but got %s; for context %s'))
                    ->format(ContextInterface::class, $obj, $key);
            }

            if (!$obj->contextMatch($event)) {
                continue;
            }

            $app->log(Log\ContextMatched::class, [$key]);

            if (isset($context->listeners)) {
                foreach ($context->listeners as $listenerClass) {
                    $listener = $app->get($listenerClass);
                    $listener and $app->bind($listener);
                }
            }

            $contexts[$key] = $context;
        }

        $app->emit(new ContextEvent($app, $contexts));
    }
}
