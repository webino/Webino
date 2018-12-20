<?php

namespace Webino;

/**
 * Class FormInputText
 * @package webino-form
 */
class FormInputText extends AbstractFormValueInput
{
    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $newNode = parent::renderHtmlNode($htmlNode);
        $newNode['type'] = 'text';
        return $newNode;
    }
}
