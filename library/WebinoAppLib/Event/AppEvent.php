<?php

namespace WebinoAppLib\Event;

use WebinoEventLib\Event;

/**
 * Class AppEvent
 */
class AppEvent extends Event implements
    AppEventInterface
{
    use AppEventTrait;
}
