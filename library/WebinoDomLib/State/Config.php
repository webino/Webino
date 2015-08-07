<?php

namespace WebinoDomLib\State;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class Config
 */
class Config extends AbstractFeature
{
    /**
     * Spec list.
     *
     * @var array
     */
    private $items = [];

    /**
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param string $name Spec name.
     * @return SpecConfig
     */
    public function set($name)
    {
        if (is_object($name) && $name instanceof AbstractSpecConfig) {
            $this->items[$name->getName()] = $name;
            return $name;
        }

        if (empty($this->items[$name])) {
            $this->items[$name] = new SpecConfig($name);
        }
        return $this->items[$name];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->items as $name => $item) {
            if ($item instanceof AbstractSpecConfig) {
                $result[$name] = $item->toArray();

            } elseif (is_array($item)) {
                $result[$name] = $item;
            }
        }
        return $result;
    }
}
