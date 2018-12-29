<?php

namespace Webino;

/**
 * Class AbstractFormButton
 * @package webino-form
 */
abstract class AbstractFormButton extends AbstractFormInput implements FormButtonInterface, HtmlPartInterface
{
    use FormWithStyleTrait;

    /**
     * @var string
     */
    protected $label;

    /**
     * @param string $name
     * @param string $label
     */
    function __construct(string $name, string $label)
    {
        parent::__construct($name);
        $this->label = $label;
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

        // input
        $newNode = parent::renderHtmlNode($htmlNode);
        $newNode['type'] = 'submit';
        $newNode['value'] = $this->label;
        $style->renderInputHtmlNode($newNode);

        return $newNode;
    }
}
