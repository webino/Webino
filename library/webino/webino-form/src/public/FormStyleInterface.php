<?php

namespace Webino;

/**
 * Interface FormStyleInterface
 * @package webino-form
 */
interface FormStyleInterface
{
    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderFormHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface;

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderInputGroupHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface;

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderLabelHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface;

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderInputHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface;
}
