<?php

namespace Webino;

/**
 * Class FormInputLabel
 * @package webino-form
 */
class FormInputLabel
{
    use FormWithStyleTrait;

    /**
     * Form input label text
     *
     * @var string
     */
    protected $label;

    /**
     * @param string $label
     */
    function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $style = $this->getStyle();

        // label
        $labelNode = $htmlNode->addNode('label');
        $style->renderLabelHtmlNode($labelNode);

        // text
        $spanNode = $labelNode->addNode('span');
        $spanNode->setText($this->label);

        return $labelNode;
    }
}
