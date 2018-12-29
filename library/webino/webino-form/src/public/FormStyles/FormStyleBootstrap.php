<?php

namespace Webino;

/**
 * Class FormStyleBootstrap
 * @package webino-form
 */
final class FormStyleBootstrap implements FormStyleInterface
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
        $htmlNode['class'] = 'form-group';
        return $htmlNode;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderLabelHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $htmlNode['class'] = 'w-100';
        return $htmlNode;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderInputHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        if ('submit' === $htmlNode['type']) {
            $htmlNode['class'] = 'btn btn-primary';
            return $htmlNode;
        }

        $htmlNode['class'] = 'form-control';
        return $htmlNode;
    }
}
