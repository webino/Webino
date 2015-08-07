<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Feature\Debugger;
use WebinoAppLib\Event\AppEvent;
use WebinoEventLib\AbstractListener;
use Zend\Http\Response;

/**
 * Class DebuggerListener
 */
class DebuggerListener extends AbstractListener
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->listen(AppEvent::BOOTSTRAP, 'setupInfo', AppEvent::BEGIN * 99);
        $this->listen(AppEvent::BOOTSTRAP, 'setBarPanels', AppEvent::BEGIN * 99);
    }

    /**
     * @param AppEvent $event
     */
    public function setupInfo(AppEvent $event)
    {
        $config = $event->getApp()->getConfig(Debugger::DEBUGGER);
        if (empty($config)) {
            return;
        }

        $info = $config->{Debugger::INFO};
        if (empty($info)) {
            return;
        }

        /** @var \Tracy\DefaultBarPanel $panel */
        $panel = $event->getApp()->getDebugger()->getBarPanel('Tracy:info');
        $panel and $panel->data = $info->toArray();
    }

    /**
     * @param AppEvent $event
     */
    public function setBarPanels(AppEvent $event)
    {
        $app = $event->getApp();
        $cfg = $app->getConfig(Debugger::DEBUGGER);

        if (empty($cfg)) {
            return;
        }

        $panels = $cfg->{Debugger::BAR_PANELS};
        if (empty($panels)) {
            return;
        }

        foreach ($panels as $panel) {
            $app->has($panel) and $app->getDebugger()->setBarPanel($app->get($panel));
        }
    }
}
