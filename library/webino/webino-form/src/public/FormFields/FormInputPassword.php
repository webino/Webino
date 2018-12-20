<?php

namespace Webino;

/**
 * Class FormInputPassword
 * @package webino-form
 */
class FormInputPassword extends AbstractFormValueInput
{
    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $newNode = parent::renderHtmlNode($htmlNode);
        $newNode['type'] = 'password';
        $newNode['value'] = '';
        return $newNode;
    }
}
