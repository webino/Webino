<?php

namespace WebinoAppLib\Debugger;

use Tracy\IBarPanel;

/**
 * Interface DebuggingInterface
 */
interface DebuggingInterface
{
    /**
     * Set debugger system info
     *
     * @param string|array $info
     * @param string|null $value
     * @return $this
     */
    public function setBarInfo($info, $value = null);

    /**
     * @param object|IBarPanel $panel
     * @param string|null $id
     * @return $this
     */
    public function setBarPanel(IBarPanel $panel, $id = null);

    /**
     * Dump information about a variable in Tracy Debug Bar.
     *
     * @param mixed $subject Variable to dump
     * @param string $title Optional title
     * @param array $options Dumper options
     * @return mixed Variable itself
     */
    public function barDump($subject, $title = null, array $options = null);

    /**
     * Start/stop stopwatch
     *
     * @param string $name
     * @return float Elapsed seconds
     */
    public function timer($name);
}
