<?php

namespace WebinoAppLib\Service;

use Tracy\Bar;
use Tracy\Debugger as Tracy;
use Tracy\IBarPanel;
use WebinoAppLib\Options\DebuggerOptions;
use WebinoBaseLib\Tracy\Workaround\DisabledBar;

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

        // TODO issue https://github.com/nette/tracy/pull/83
        if (!$_options->hasBar() && !class_exists(Bar::class, false)) {
            class_alias(DisabledBar::class, Bar::class);
        }

        Tracy::enable(
            $_options->getMode(),
            $_options->getLog(),
            $_options->getEmail()
        );

        Tracy::$strictMode = $_options->isStrict();
        Tracy::$maxDepth   = $_options->getMaxDepth();
        Tracy::$maxLen     = $_options->getMaxLen();
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
     * @return self
     */
    public function setBarPanel(IBarPanel $panel)
    {
        Tracy::getBar()->addPanel($panel);
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
