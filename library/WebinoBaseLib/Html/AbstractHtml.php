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
     * @param string $value
     * @return $this
     */
    protected function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    protected function addAttribute($name, $value)
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
        $this->addAttribute('title', $title);
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->addAttribute('class', $class);
        return $this;
    }

    /**
     * @param string $style
     * @return $this
     */
    public function setStyle($style)
    {
        $this->addAttribute('style', $style);
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

        $tag = $this->getTagName();
        $value = $this->escape ? $escaper->escapeHtml($this->value) : $this->value;
        return sprintf('<%s %s>%s</%s>', $tag, join(' ', $attribs), $value, $tag);
    }
}
