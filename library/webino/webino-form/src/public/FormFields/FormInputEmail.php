<?php

namespace Webino;

/**
 * Class FormInputEmail
 * @package webino-form
 */
class FormInputEmail extends AbstractFormValueInput
{
    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $newNode = parent::renderHtmlNode($htmlNode);
        $newNode['type'] = 'email';
        return $newNode;
    }
}
