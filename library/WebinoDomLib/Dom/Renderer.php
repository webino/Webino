<?php

namespace WebinoDomLib\Dom;

use WebinoDomLib\Dom;
use WebinoDomLib\State\Spec;
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
     * @param State $state
     */
    public function render(Dom $doc, State $state)
    {
        /** @var Spec $spec */
        foreach ($state->getQueue() as $spec) {

            // TODO skip if locator or node owner document empty

            $nodes = $doc->locate($spec->getLocator());
            foreach ($nodes as $node) {
                // TODO DomEvent
                $this->getEvents()->trigger(__FUNCTION__, $this, ['node' => $node, 'spec' => $spec]);
            }
        }
    }
}
