<?php

namespace WebinoAppLib\Service;

use WebinoAppLib\Debugger\DebuggingInterface;

/**
 * Interface DebuggerInterface
 */
interface DebuggerInterface extends DebuggingInterface
{
    /**
     * @param string $id
     * @return \Tracy\IBarPanel|null
     */
    public function getBarPanel($id);

    /**
     * Dump a variable in readable format
     *
     * @param mixed $subject
     * @param bool $return Return dump of a variable in readable format.
     * @return mixed Variable itself
     */
    public function dump($subject, $return = false);
}
