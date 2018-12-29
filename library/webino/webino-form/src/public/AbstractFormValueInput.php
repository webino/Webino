<?php

namespace Webino;

/**
 * Class AbstractFormValueInput
 * @package webino-form
 */
abstract class AbstractFormValueInput extends AbstractFormInput implements FormFieldInterface, HtmlPartInterface
{
    use FormFieldTrait;
    use FormValueInputTrait;
    use FormWithStyleTrait;

    /**
     * @param string $name
     * @param iterable $options
     */
    function __construct(string $name, iterable $options = [])
    {
        parent::__construct($name);
        $this->setOptions($options);
    }

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
        $newNode = parent::renderHtmlNode($labelNode);
        $newNode['value'] = $this->getData();
        $style->renderInputHtmlNode($newNode);

        // TODO error
        $newNode['class'].= ' is-invalid';
        $errorNode = $labelNode->addNode('div');
        $errorNode['class'] = 'invalid-feedback';
        $errorNode->setText('Value is required!');

        return $newNode;
    }
}
