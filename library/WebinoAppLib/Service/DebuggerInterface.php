<?php

namespace WebinoAppLib\Service;

use Tracy\IBarPanel;

/**
 * Interface DebuggerInterface
 */
interface DebuggerInterface
{
    /**
     * @param string $id
     * @return IBarPanel|null
     */
    public function getBarPanel($id);

    /**
     * @param object|IBarPanel $panel
     * @return self
     */
    public function setBarPanel(IBarPanel $panel);

    /**
     * Dump a variable in readable format
     *
     * @param mixed $subject
     * @param bool $return Return dump of a variable in readable format.
     * @return mixed Variable itself
     */
    public function dump($subject, $return = false);

    /**
     * Dump information about a variable in Tracy Debug Bar.
     *
     * @param mixed $subject Variable to dump
     * @param string $title Optional title
     * @param array $options Dumper options
     * @return mixed Variable itself
     */
    public function barDump($subject, $title = NULL, array $options = NULL);

    /**
     * Start/stop stopwatch
     *
     * @param string $name
     * @return float Elapsed seconds
     */
    public function timer($name);
}
