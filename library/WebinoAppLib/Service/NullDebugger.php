<?php

namespace WebinoAppLib\Service;

use Tracy\IBarPanel;

/**
 * Class NullDebugger
 */
class NullDebugger implements DebuggerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBarPanel($id)
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setBarPanel(IBarPanel $panel)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function dump($subject, $return = false)
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function barDump($subject, $title = null, array $options = null)
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function timer($name = null)
    {
        return 0;
    }
}
