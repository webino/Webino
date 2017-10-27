<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
            ->setReplace(new SourcePreview($this->filePath));
    }
}
