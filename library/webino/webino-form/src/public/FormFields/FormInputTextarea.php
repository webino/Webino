<?php

namespace Webino;

/**
 * Class FormInputTextarea
 * @package webino-form
 */
class FormInputTextarea extends AbstractFormField
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

        // TODO label
        $labelNode = $htmlNode->addNode('label');
        $labelNode['class'] = 'w-100';
        $htmlNode = $labelNode;

        $newNode = $htmlNode->addNode('textarea');
        $newNode->setText($this->getData());
        $newNode['name'] = $this->getName();

        // TODO style
        $newNode['class'] = 'form-control';

        return $newNode;
    }
}
