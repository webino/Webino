<?php

namespace WebinoDomLib\Dom\Config;

use WebinoConfigLib\AbstractConfig;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class AbstractSpecConfig
 */
abstract class AbstractSpecConfig extends AbstractConfig implements
    FeatureInterface
{
    /**
     * Spec key
     *
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $locator
     * @return $this
     */
    public function setLocator($locator)
    {
        $this->mergeArray(['locator' => (string) $locator]);
        return $this;
    }

    /**
     * @param int $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->mergeArray(['priority' => (int) $priority]);
        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->mergeArray(['options' => $options]);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        // set default locator by component name
        $this->getData()->offsetExists('locator') or $this->setLocator($this->getName());
        return parent::toArray();
    }
}
