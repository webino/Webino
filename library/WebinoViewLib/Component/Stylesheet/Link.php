<?php

namespace WebinoViewLib\Component\Stylesheet;

use WebinoViewLib\Component\AbstractBaseViewComponent;
use WebinoViewLib\Feature\NodeView;

/**
 * Class Link
 */
class Link extends AbstractBaseViewComponent
{
    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string|null $href Stylesheet source URL
     * @param string|null $name Config spec key name
     */
    public function __construct($href = null, $name = null)
    {
        $this->href = (string) $href;
        $this->name = (string) $name;
    }

    /**
     * {@inheritdoc}
     */
    protected function getSpecName()
    {
        return $this->name;
    }

    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node
            ->setPriority(-100)
            ->setLocator('head')
            ->setHtml('{$_innerHtml} <link href="' . $this->href . '" rel="stylesheet"/>');
    }
}
