<?php

namespace Webino;

/**
 * Class AbstractFormInput
 * @package webino-form
 */
abstract class AbstractFormInput
{
    use FormInputTrait;

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $newNode = $htmlNode->addNode('input');
        $newNode['name'] = $this->getName();
        return $newNode;
    }
}
