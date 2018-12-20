<?php

namespace Webino;

/**
 * Class AbstractFormButton
 * @package webino-form
 */
abstract class AbstractFormButton extends AbstractFormInput implements HtmlPartInterface
{
    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        // TODO style
        $groupNode = $htmlNode->addNode('div');
        $groupNode['class'] = 'form-group';
        $htmlNode = $groupNode;

        $newNode = parent::renderHtmlNode($htmlNode);
        $newNode['type'] = 'submit';

        // TODO style
        $newNode['class'] = 'btn btn-primary';

        return $newNode;
    }
}
