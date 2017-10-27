<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoHtmlLib\Html;

/**
 * Class FieldSet
 */
class FieldSet extends AbstractHtml
{
    /**
     * @var string
     */
    private $legend;

    /**
     * @param string $legend
     * @param string|array|HtmlInterface $value
     */
    public function __construct($legend, $value)
    {
        $this->legend = $legend;
        $this->setValue($value);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'FieldSet';
    }

    /**
     * {@inheritdoc}
     */
    protected function toStringInternal($tag, $attribs, $value)
    {
        return sprintf('<%s %s><legend>%s</legend>%s</%s>', $tag, $attribs, $this->legend, $value, $tag);
    }
}
