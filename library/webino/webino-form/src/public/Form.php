<?php

namespace Webino;

/**
 * Class Form
 * @package webino-form
 */
class Form implements \IteratorAggregate, HtmlPartInterface
{
    /**
     * GET forms by default
     */
    protected const METHOD = 'get';

    /**
     * @var iterable
     */
    private $inputs;

    /**
     * @param iterable $inputs
     */
    function __construct(iterable $inputs)
    {
        $this->inputs = $inputs;
    }

    /**
     * @return \Iterator
     */
    function getIterator(): \Iterator
    {
        foreach ($this->inputs as $input) {
            yield $input;
        }
    }

    /**
     * Submit form
     *
     * @param HttpRequestInterface $request
     * @return bool True if dispatched
     */
    function submit(HttpRequestInterface $request): bool
    {
        if ($this::METHOD !== $request->getMethod()) {
            return false;
        }

        foreach ($this->inputs as $input) {
            switch (true) {
                case $input instanceof AbstractFormButton:
                    if (isset($request[$input->getName()])) {
                        $this->setData($request);
                        return true;
                    }
                    break;
            }
        }
        return false;
    }

    /**
     * Returns true when form data is valid
     *
     * @return bool
     */
    function isValid(): bool
    {
        $isValid = true;
        foreach ($this->inputs as $input) {
            switch (true) {
                case $input instanceof FormFieldInterface:
                    $input->isValid() or $isValid = false;
                    break;
            }
        }
        return $isValid;
    }

    /**
     * Set form fields data
     *
     * @param iterable $data
     */
    function setData(iterable $data): void
    {
        foreach ($this->inputs as $input) {
            switch (true) {
                case $input instanceof FormFieldInterface:
                    $input->setData($data[$input->getName()] ?? '');
                    break;
            }
        }
    }

    /**
     * Return form fields data
     *
     * @return iterable
     */
    function getData(): iterable
    {
        $data = [];
        foreach ($this->inputs as $input) {
            switch (true) {
                case $input instanceof FormFieldInterface:
                    $data[$input->getName()] = $input->getData();
                    break;
            }
        }
        return $data;
    }

    /**
     * @param HtmlNodeInterface $htmlNode
     * @return HtmlNodeInterface
     */
    function renderHtmlNode(HtmlNodeInterface $htmlNode): HtmlNodeInterface
    {
        $htmlNode->rename('form');
        $htmlNode['method'] = $this::METHOD;

        foreach ($this->inputs as $input) {
            switch (true) {
                case $input instanceof HtmlPartInterface:
                    $input->renderHtmlNode($htmlNode);
                    break;
            }
        }

        return $htmlNode;
    }
}
