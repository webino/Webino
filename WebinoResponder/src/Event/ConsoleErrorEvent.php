<?php

namespace Webino\Event;

/**
 * Class ConsoleErrorEvent
 */
class ConsoleErrorEvent extends ConsoleResponseEvent
{
    use ErrorEventTrait;
}
