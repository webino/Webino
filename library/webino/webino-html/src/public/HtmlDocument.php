<?php

namespace Webino;

/**
 * Class HtmlDocument
 * @package webino-html
 */
class HtmlDocument extends AbstractHtmlDocument
{
    /**
     * HTML fixes
     */
    protected const HTML_FIX = parent::HTML_FIX + self::HTML_ENCODING_FIX;

    /**
     * DOMDocument UTF-8 encoding fix
     */
    protected const HTML_ENCODING_FIX = [
        '<meta charset="UTF-8">' => '<meta http-equiv="content-type" content="text/html; charset=utf-8">',
    ];
}
