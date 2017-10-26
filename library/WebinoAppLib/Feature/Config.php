<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application\AbstractConfig;

/**
 * Class Config
 */
class Config extends AbstractConfig
{
    /**
     * Return core listeners
     *
     * @return array|null
     */
    private function takeCoreServices()
    {
        $coreData = $this->getData()->{$this::CORE};
        if (empty($coreData[$this::SERVICES])) {
            return [];
        }

        $services = $coreData[$this::SERVICES];
        unset($coreData[$this::SERVICES]);

        return [$this::CORE => [$this::SERVICES => $services]];
    }

    /**
     * @param array $merge
     * @return $this
     */
    protected function mergeArray(array $merge)
    {
        array_walk_recursive($merge, function (&$item) {
            if ($item instanceof self) {
                $this->mergeArray($item->takeCoreServices());
                $item = $item->toArray();
            }
        });

        parent::mergeArray($merge);
        return $this;
    }
}
