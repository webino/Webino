<?php

namespace WebinoViewLib\Component\Javascript;

use WebinoViewLib\Component\AbstractBaseViewComponent;
use WebinoViewLib\Feature\NodeView;

/**
 * Class ScriptSrc
 */
class Src extends AbstractBaseViewComponent
{
    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string|null $src Javascript source URL
     * @param string|null $name Config spec key name
     */
    public function __construct($src = null, $name = null)
    {
        $this->src  = (string) $src;
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
            ->setPriority(-110)
            ->setLocator('head')
            ->setHtml('{$_innerHtml} <script src="' . $this->src . '"></script>');
    }
}
