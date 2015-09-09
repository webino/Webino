<?php

namespace WebinoDomLib\Dom;

use WebinoDomLib\Dom;
use WebinoDomLib\Event\RenderEvent;
use WebinoEventLib\EventsAwareInterface;
use WebinoEventLib\EventsAwareTrait;

/**
 * Class Renderer
 */
class Renderer implements EventsAwareInterface
{
    use EventsAwareTrait;

    /**
     * @param Dom $doc
     * @param State $cfg
     */
    public function render(Dom $doc, Config $cfg)
    {
        /** @var Spec $spec */
        foreach ($cfg->getQueue() as $spec) {

            // TODO skip if locator or node owner document empty

            $nodes = $doc->locate($spec->getLocator());
            foreach ($nodes as $node) {
                $this->getEvents()->trigger(new RenderEvent($this, $node, $spec));
            }
        }
    }
}
