<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoEventLib\AbstractListener;
use Zend\Http\PhpEnvironment\Response;

/**
 * Class ViewListener
 */
final class ViewListener extends AbstractListener
{
    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(Response::class, [$this, 'renderHtml'], AppEvent::FINISH * 99);
    }

    /**
     * @param DispatchEvent $event
     */
    public function renderHtml(DispatchEvent $event)
    {
//        die('RENDER HTML');
    }
}
