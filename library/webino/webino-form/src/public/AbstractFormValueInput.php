<?php

namespace Webino;

/**
 * Class AbstractFormValueInput
 * @package webino-form
 */
abstract class AbstractFormValueInput extends AbstractFormInput implements FormFieldInterface, HtmlPartInterface
{
    use FormValueInputTrait;

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

        // TODO label
        $labelNode = $htmlNode->addNode('label');
        $labelNode['class'] = 'w-100';
        $htmlNode = $labelNode;

        // TODO style
        $newNode = parent::renderHtmlNode($htmlNode);
        $newNode['value'] = $this->getData();
        $newNode['class'] = 'form-control';

        return $newNode;
    }
}
