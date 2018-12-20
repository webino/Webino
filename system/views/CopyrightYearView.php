<?php

namespace Webino;

/**
 * Class CopyrightYearView
 */
class CopyrightYearView
{
    /**
     * @param ViewEvent $event
     */
    function view(ViewEvent $event): void
    {
        // TODO since year setting
        $event->getNode()->replaceWithText(date('Y'));
    }
}
