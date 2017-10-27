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

use WebinoBaseLib\Util\ToString;

/**
 * Class AbstractHtml
 */
abstract class AbstractHtml implements HtmlInterface
{
    use EscaperAwareTrait;
    use FormatTrait;

    /**
     * @var string
     */
    private $value;

    /**
     * @var array
     */
    private $attribs = [];

    /**
     * @return string
     */
    abstract protected function getTagName();

    /**
     * @param string|array|object $value New value;current value placeholder is `%s`
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = strtr($this->normalizeValue($value), ['%s' => $this->value]);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    protected function setAttribute($name, $value)
    {
        $this->attribs[$name] = $value;
        return $this;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->setAttribute('title', $title);
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->setAttribute('class', $class);
        return $this;
    }

    /**
     * @param array|string $style
     * @param string|null $value
     * @return $this
     */
    public function setStyle($style, $value = null)
    {
        $styleData = [];

        if (!empty($this->attribs['style'])) {
            call_user_func(function () use (&$styleData) {
                foreach (explode(';', $this->attribs['style']) as $pair) {
                    list($name, $value) = explode(':', $pair);
                    $styleData[trim($name)] = trim($value);
                }
            });
        }

        if (is_array($style)) {
            foreach ($style as $name => $value) {
                $styleData[$name] = $value;
            }

        } elseif (null !== $value) {
            $styleData[$style] = $value;

        } elseif (isset($styleData[$style])) {
            unset($styleData[$style]);
        }

        $stylePairs = [];
        foreach ($styleData as $name => $value) {
            $stylePairs[] = $name . ': ' . $value;
        }

        $this->setAttribute('style', join('; ', $stylePairs));
        return $this;
    }

    /**
     * @param string|array|HtmlInterface $value
     * @return string
     */
    private function normalizeValue($value)
    {
        if ($value instanceof HtmlInterface) {
            return ToString::value($value);
        }

        if (is_array($value)) {
            $newValue = '';
            foreach ($value as $subValue) {
                $newValue .= $this->normalizeValue($subValue);
            }
            return $newValue;
        }

        return $this->getEscaper()->escapeHtml(ToString::value($value));
    }

    /**
     * @param string $tag
     * @param string $attribs
     * @param string $value
     * @return string
     */
    protected function toStringInternal($tag, $attribs, $value)
    {
        return $this->doFormat(sprintf('<%s %s>%s</%s>', $tag, $attribs, $value, $tag));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $escaper = $this->getEscaper();
        $attribs = [];

        foreach ($this->attribs as $attrib => $value) {

            empty($value)
                or $attribs[] = sprintf(
                    '%s="%s"',
                    $escaper->escapeHtml($attrib),
                    $escaper->escapeHtmlAttr($value)
                );
        }

        $tag = $this->getTagName();
        return $this->toStringInternal($tag, join(' ', $attribs), $this->value);
    }
}
