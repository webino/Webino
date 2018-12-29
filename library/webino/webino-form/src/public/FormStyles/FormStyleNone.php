<?php

namespace Webino;

/**
 * Class FormStyleNone
 * @package webino-form
 */
final class FormStyleNone implements FormStyleInterface
{
    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderFormHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        return $htmlNode;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderInputGroupHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        return $htmlNode;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderLabelHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        return $htmlNode;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderInputHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        return $htmlNode;
    }
}
