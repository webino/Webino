<?php

namespace Webino;

/**
 * Class ViewEvent
 * @package webino-view
 */
class ViewEvent extends AppEvent implements HtmlViewEventInterface
{
    use HtmlViewEventTrait;
}
