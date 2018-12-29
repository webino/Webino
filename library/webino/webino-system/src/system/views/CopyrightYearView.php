<?php

namespace Webino;

/**
 * Class CopyrightYearView
 */
class CopyrightYearView
{
    /**
     * Copyright year since
     *
     * @var int
     */
    static $since;

    /**
     * @param ViewEvent $event
     */
    function view(ViewEvent $event): void
    {
        $year = date('Y');
        $text = ($this::$since >= $year || !$this::$since) ? $year : "{$this::$since}-{$year}";
        $event->getNode()->replaceWithText($text);
    }
}
