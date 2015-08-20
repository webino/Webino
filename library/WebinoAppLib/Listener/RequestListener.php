<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoEventLib\AbstractListener;
use Zend\Mvc\Service\RequestFactory;

/**
 * Class RequestListener
 */
final class RequestListener extends AbstractListener
{
    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(AppEvent::DISPATCH, [$this, 'createRequest'], AppEvent::BEGIN * 999);
    }

    /**
     * @param DispatchEvent $event
     */
    public function createRequest(DispatchEvent $event)
    {
        $request = (new RequestFactory)->createService($event->getApp()->getServices());
        $event->setParam(DispatchEvent::REQUEST, $request);
    }
}
