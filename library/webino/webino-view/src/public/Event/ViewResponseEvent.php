<?php

namespace Webino;

/**
 * Class ViewResponseEvent
 * @package webino-view
 */
class ViewResponseEvent extends AppEvent
{
    use HttpRequestEventTrait;
    use HtmlViewEventTrait;
    use ViewEventTrait;
}
