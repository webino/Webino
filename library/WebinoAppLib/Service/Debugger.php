<?php

namespace WebinoAppLib\Service;

use Tracy\Debugger as Tracy;
use Tracy\IBarPanel;
use WebinoAppLib\Options\DebuggerOptions;

/**
 * Class Debugger
 */
class Debugger implements DebuggerInterface
{
    /**
     * @var DebuggerOptions
     */
    private $options;

    /**
     * @param array|DebuggerOptions $options
     */
    public function __construct($options = null)
    {
        $_options = !($options instanceof DebuggerOptions)
            ? new DebuggerOptions((array) $options)
            : $options;

        $this->options = $_options;
        if ($_options->isDisabled() || Tracy::isEnabled()) {
            return;
        }

        Tracy::enable(
            $_options->getMode(),
            $_options->getLog(),
            $_options->getEmail()
        );

        Tracy::$showBar    = $_options->hasBar();
        Tracy::$strictMode = $_options->isStrict();
        Tracy::$maxDepth   = $_options->getMaxDepth();
        Tracy::$maxLength  = $_options->getMaxLen();
    }

    /**
     * @param string $id
     * @return IBarPanel|null
     */
    public function getBarPanel($id)
    {
        return Tracy::getBar()->getPanel($id);
    }

    /**
     * @param object|IBarPanel $panel
     * @param string|null $id
     * @return $this
     */
    public function setBarPanel(IBarPanel $panel, $id = null)
    {
        Tracy::getBar()->addPanel($panel, $id);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setBarInfo($info, $value = null)
    {
        $_info = is_string($info) ? $info = [$info => (string) $value] : (array) $info;

        /** @var \Tracy\DefaultBarPanel $panel */
        $panel = $this->getBarPanel('Tracy:info');
        $panel and $panel->data = array_replace(is_array($panel->data) ? $panel->data : [], $_info);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function dump($subject, $return = false)
    {
        return Tracy::dump($subject, $return);
    }

    /**
     * {@inheritdoc}
     */
    public function barDump($subject, $title = null, array $options = null)
    {
        Tracy::barDump($subject, $title, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function timer($name = null)
    {
        return Tracy::timer($name);
    }
}
