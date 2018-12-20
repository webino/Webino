<?php

namespace Webino;

/**
 * Class ViewLayoutEvent
 * @package webino-view
 */
class ViewLayoutEvent extends AppEvent
{
    use HttpRequestEventTrait;
    use HtmlViewEventTrait;
    use ViewEventTrait;
}
