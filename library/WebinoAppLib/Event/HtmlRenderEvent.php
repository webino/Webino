<?php

namespace WebinoAppLib\Event;

/**
 * Class HtmlRenderEvent
 */
class HtmlRenderEvent extends DispatchEvent
{
    /**
     * @var DispatchEvent
     */
    private $parentEvent;

    /**
     * @param DispatchEvent $event
     */
    public function __construct(DispatchEvent $event)
    {
        dd(__CLASS__);

//        parent::__construct($event->getApp());
//        $this->parentEvent = $event;
//
//        $this->setName($this::MATCH);
//        $this->setParam($this::REQUEST, $event->getRequest());
    }


}
