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
     * @param NodeLocatorInterface $doc
     * @param State $cfg
     */
    public function render(NodeLocatorInterface $doc, Config $cfg, RenderEvent $parentEvent = null, callable $callback = null)
    {
        /** @var Config\Spec $spec */
        foreach ($cfg->getQueue() as $spec) {
            // TODO skip if locator or node owner document empty

            $events = $this->getEvents();
            $nodes  = $doc->locate($spec->getLocator());

            $callback and call_user_func($callback, $spec, $nodes);

            /** @var NodeInterface $node */
            foreach ($nodes as $node) {

                $event = new RenderEvent($this, $node, $spec, $parentEvent);

                $events->attach(RenderEvent::class, function (RenderEvent $subEvent) use ($spec, $event) {
                    $view = $spec->getView();
                    if (empty($view)) {
                        return;
                    }

                    $this->render(
                        $subEvent->getNode(),
                        new Config($view),
                        $event,
                        function(Config\Spec $spec, NodeList $nodes) use ($subEvent) {
                            $subEvent->setNode($nodes, $spec->getKey());
                        }
                    );
                }, RenderEvent::FINISH);


                $events->trigger($event);
            }
        }
    }
}
