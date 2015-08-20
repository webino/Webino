<?php

namespace WebinoBaseLib\Html;

/**
 * Class AbstractHtml
 */
abstract class AbstractHtml
{
    use EscaperAwareTrait;

    /**
     * @var string
     */
    private $value;

    /**
     * @var array
     */
    private $attribs = [];

    /**
     * Escape HTML value
     *
     * @var bool
     */
    private $escape = true;

    /**
     * @return string
     */
    abstract protected function getTagName();

    /**
     * @param string $value New value;current value placeholder is `%s`
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = sprintf($value, $this->value);
        return $this;
    }

    /**
     * @deprecated
     */
    protected function addAttribute($name, $value)
    {
        return $this->setAttribute($name, $value);
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

        if (isset($this->attribs['style'])) {
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
        }

        $stylePairs = [];
        foreach ($styleData as $name => $value) {
            $stylePairs[] = $name . ': ' . $value;
        }

        $this->setAttribute('style', join('; ', $stylePairs));
        return $this;
    }

    /**
     * Set to escape a value
     *
     * @param string $bool
     * @return $this
     */
    protected function setEscape($bool)
    {
        $this->escape = (bool) $bool;
        return $this;
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

        $tag   = $this->getTagName();
        $value = $this->escape ? $escaper->escapeHtml($this->value) : $this->value;

        return $this->toStringInternal($tag, join(' ', $attribs), $value);
    }

    /**
     * @param string $tag
     * @param string $attribs
     * @param string $value
     * @return string
     */
    protected function toStringInternal($tag, $attribs, $value)
    {
        return sprintf('<%s %s>%s</%s>', $tag, $attribs, $value, $tag);
    }
}
