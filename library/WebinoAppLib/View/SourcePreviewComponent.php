<?php

namespace WebinoAppLib\View;

use WebinoAppLib\Response\Content\SourcePreview;
use WebinoViewLib\Component\AbstractBaseViewComponent;
use WebinoViewLib\Feature\NodeView;

/**
 * Class SourcePreviewComponent
 */
class SourcePreviewComponent extends AbstractBaseViewComponent
{
    /**
     * @var string
     */
    private $filePath;

    /**
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @param NodeView $node
     */
    public function configure(NodeView $node)
    {
        $node
            ->setLocator('source-preview')
            ->setPriority(-100)
            ->setHtml(new SourcePreview($this->filePath));
    }
}
