<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
        $options instanceof DebuggerOptions
            or $options = new DebuggerOptions((array) $options);

        $this->options = $options;
        if ($options->isDisabled() || Tracy::isEnabled()) {
            return;
        }

        Tracy::enable(
            $options->getMode(),
            $options->getLog(),
            $options->getEmail()
        );

        Tracy::$showBar    = $options->hasBar();
        Tracy::$strictMode = $options->isStrict();
        Tracy::$maxDepth   = $options->getMaxDepth();
        Tracy::$maxLength  = $options->getMaxLen();
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
