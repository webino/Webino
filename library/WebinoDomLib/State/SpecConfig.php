<?php

namespace WebinoDomLib\State;

/**
 * Class SpecConfig
 */
class SpecConfig extends AbstractSpecConfig implements
    SpecInterface
{
    /**
     * @param string $value Node value.
     * @return self
     */
    public function setValue($value)
    {
        $this->mergeArray(['value' => $value]);
        return $this;
    }

    /**
     * @param string $html Valid XHTML code.
     * @return self
     */
    public function setHtml($html)
    {
        $this->mergeArray(['html' => $html]);
        return $this;
    }
}
