<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory\View;

use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\DefaultView;
use WebinoDomLib\Dom;

/**
 * Class DomRendererFactory
 */
class DomRendererFactory extends AbstractFactory
{
    /**
     * Create DOM renderer
     *
     * @return Dom\Renderer
     */
    protected function create()
    {
        $renderer = new Dom\Renderer;
        $events   = $renderer->getEvents();

        // TODO listeners constant
        $listeners = $this->getConfig(DefaultView::KEY)['listeners'];

        // TODO listeners debug profile
        //pd($listeners);

        foreach ($listeners as $class) {
            /** @var \Zend\EventManager\ListenerAggregateInterface $listener */
            $listener = $this->getServices()->get($class);
            $events->attach($listener);
        }

        return $renderer;
    }
}
