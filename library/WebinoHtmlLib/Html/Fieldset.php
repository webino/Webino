<?php

namespace WebinoHtmlLib\Html;

/**
 * Class Fieldset
 */
final class Fieldset extends AbstractHtml
{
    /**
     * @var string
     */
    private $legend;

    /**
     * @param string $legend
     * @param string|array $value
     * @param bool $escape
     */
    public function __construct($legend, $value, $escape = false)
    {
        $this->legend = $legend;
        $this->setValue($value);
        $this->setEscape($escape);
    }

    /**
     * @return string
     */
    protected function getTagName()
    {
        return 'fieldset';
    }

    /**
     * {@inheritdoc}
     */
    protected function toStringInternal($tag, $attribs, $value)
    {
        return sprintf('<%s %s><legend>%s</legend>%s</%s>', $tag, $attribs, $this->legend, $value, $tag);
    }
}