<?php

namespace WebinoDomLib\Dom;

use WebinoDomLib\Dom;
use WebinoDomLib\State\Spec;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

/**
 * Class Renderer
 */
class Renderer implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

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
                $this->getEventManager()->trigger(__FUNCTION__, $this, ['node' => $node, 'spec' => $spec]);
            }
        }
    }
}
