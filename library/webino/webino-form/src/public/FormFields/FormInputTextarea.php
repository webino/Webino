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
        $style = $this->getStyle();

        // group
        $groupNode = $htmlNode->addNode('div');
        $style->renderInputGroupHtmlNode($groupNode);

        // label
        $labelNode = $this->getLabel()->renderHtmlNode($groupNode);

        // input
        $newNode = $labelNode->addNode('textarea');
        $newNode->setText($this->getData());
        $newNode['name'] = $this->getName();
        $style->renderInputHtmlNode($newNode);

        // TODO error
        $newNode['class'].= ' is-invalid';
        $errorNode = $labelNode->addNode('div');
        $errorNode['class'] = 'invalid-feedback';
        $errorNode->setText('Value is required!');

        return $newNode;
    }
}
