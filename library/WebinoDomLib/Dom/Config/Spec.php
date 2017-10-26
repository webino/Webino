<?php

namespace WebinoDomLib\Dom\Config;

use Zend\Stdlib\AbstractOptions;

/**
 * Class Spec
 */
class Spec extends AbstractOptions implements
    SpecInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var int
     */
    private $priority;

    /**
     * @var string
     */
    private $locator;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $html;

    /**
     * @var array
     */
    private $attribs;

    /**
     * @var string
     */
    private $rename;

    /**
     * @var string
     */
    private $replace;

    /**
     * @var SpecConfig[]
     */
    private $view;

    /**
     * @param array $options
     * @param string|null $key
     */
    public function __construct(array $options = [], $key = null)
    {
        parent::__construct($options);
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasOption($name)
    {
        return isset($this->options[(string) $name]);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getOption($name)
    {
        // TODO OutOfRangeException
        return $this->options[(string) $name];
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocator()
    {
        return $this->locator;
    }

    /**
     * @param string $locator
     * @return $this
     */
    public function setLocator($locator)
    {
        $this->locator = $locator;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = (int) $priority;
        return $this;
    }
    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param string $html Valid XHTML code.
     * @return $this
     */
    public function setHtml($html)
    {
        $this->html = (string) $html;
        return $this;
    }

    /**
     * @param string $name Attribute name.
     * @param string $value Attribute value.
     * @return $this
     */
    public function setAttribute($name, $value)
    {
        $this->attribs[(string) $name] = (string) $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getAttribs()
    {
        return $this->attribs;
    }

    /**
     * @param array $attribs
     */
    public function setAttribs(array $attribs)
    {
        $this->attribs = $attribs;
        return $this;
    }

    /**
     * @return string
     */
    public function getRename()
    {
        return $this->rename;
    }

    /**
     * @param string $newName
     * @return $this
     */
    public function setRename($newName)
    {
        $this->rename = (string) $newName;
        return $this;
    }

    /**
     * @return string
     */
    public function getReplace()
    {
        return $this->replace;
    }

    /**
     * @param string $html
     * @return $this
     */
    public function setReplace($html)
    {
        $this->replace = (string) $html;
        return $this;
    }

    /**
     * @return SpecConfig[]
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param SpecConfig[] $view
     */
    public function setView(array $view)
    {
        $this->view = $view;
        return $this;
    }
}
