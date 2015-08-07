<?php

namespace WebinoDomLib\State;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class AbstractSpecConfig
 */
abstract class AbstractSpecConfig extends AbstractFeature
{
    /**
     * Spec key.
     *
     * @var string
     */
    private $name;

    /**
     * @param string $name
     * @return $this
     */
    public function __construct($name)
    {
        $this->name = $name;
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
        $this->mergeArray(['locator' => $locator]);
        return $this;
    }

    /**
     * @param mixed $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->mergeArray(['priority' => $priority]);
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
}
