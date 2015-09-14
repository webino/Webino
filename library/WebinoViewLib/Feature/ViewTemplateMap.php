<?php

namespace WebinoViewLib\Feature;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class ViewTemplateMap
 */
class ViewTemplateMap extends Config implements
    FeatureInterface,
    ViewConfigInterface,
    ViewTemplatesConfigInterface
{
    /**
     * Templates directory
     *
     * @var string
     */
    private $dir;

    /**
     * @param string $dir
     */
    public function __construct($dir)
    {
        $this->dir = $dir;
        parent::__construct();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $config = [];
        foreach ($this->createDirIterator($this->dir) as $path) {
            $info = pathinfo($path[0]);

            $index = join(
                '/',
                array_filter([
                    trim(dirname(str_replace($this->dir, '', $path[0])), '/'),
                    $info['filename'],
                ])
            );

            // TODO constant
            $config[$index] = 'file://' . $path[0];
        }

        return [$this::VIEW => [$this::TEMPLATES => $config]];
    }

    /**
     * @param string $dir
     * @return RegexIterator
     */
    private function createDirIterator($dir)
    {
        return new RegexIterator(
            new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)),
            '/^.+\..{3,4}$/i',
            RegexIterator::GET_MATCH
        );
    }
}
