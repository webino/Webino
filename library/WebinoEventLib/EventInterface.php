<?php

namespace WebinoEventLib;

/**
 * Interface EventInterface
 */
interface EventInterface
{
    /**
     * The beginning of the event
     */
    const BEGIN = 9000;

    /**
     * Before main event
     */
    const BEFORE = 5000;

    /**
     * After main event
     */
    const AFTER = -5000;

    /**
     * At the end of an event
     */
    const FINISH = -9000;

    /**
     * Event priority offset
     */
    const OFFSET = 10;
}
