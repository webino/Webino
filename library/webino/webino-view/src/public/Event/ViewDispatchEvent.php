<?php

namespace Webino;

/**
 * Class ViewDispatchEvent
 * @package webino-view
 */
class ViewDispatchEvent extends AppEvent
{
    use HttpRequestEventTrait;
    use ViewEventTrait;
}
