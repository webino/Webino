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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
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
     * @return self
     */
    public function setHtml($html)
    {
        $this->html = (string) $html;
        return $this;
    }
}
