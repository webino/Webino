<?php

namespace WebinoDomLib\Dom\Config;

use WebinoBaseLib\Util\ToString;

/**
 * Class SpecConfig
 */
class SpecConfig extends AbstractSpecConfig implements
    SpecInterface
{
    /**
     * @param string|array $value Node value.
     * @return $this
     */
    public function setValue($value)
    {
        $this->mergeArray(['value' => ToString::value($value)]);
        return $this;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return (string) $this->getData()->offsetGet('html');
    }

    /**
     * @param string|array $html Valid XHTML code.
     * @return $this
     */
    public function setHtml($html)
    {
        $this->mergeArray(['html' => ToString::value($html)]);
        return $this;
    }

    /**
     * @param string $name Attribute name.
     * @param string $value Attribute value.
     * @return $this
     */
    public function setAttribute($name, $value)
    {
        $this->mergeArray(['attribs' => [$name => $value]]);
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setAddClass($class)
    {
        $this->setAttribute('class', '{$_class} ' . $class);
        return $this;
    }

    /**
     * @param string $name New node name.
     * @return $this
     */
    public function setRename($name)
    {
        $this->mergeArray(['rename' => $name]);
        return $this;
    }

    /**
     * @param string|array $html
     * @return $this
     */
    public function setReplace($html)
    {
        $this->mergeArray(['replace' => ToString::value($html)]);
        return $this;
    }

    /**
     * @param string $name
     * @param string $template
     * @return $this
     */
    public function setSnippet($name, $template)
    {
        $this->setOptions(['snippets' => [$name => $template]]);
        return $this;
    }

    /**
     * @param array $cfg
     * @return $this
     */
    public function setView(array $cfg)
    {
        /** @var self $spec */
        foreach ($cfg as $spec) {
            $this->mergeArray(['view' => [$spec->getName() => $spec->toArray()]]);
        }
        return $this;
    }

    /**
     * @TODO concept
     * @param string $name
     * @param $func
     * @param $args
     * @return $this
     * @internal param string $template
     */
    public function setVar($name, $func, $args)
    {
        $opts = ['prop' => $name, 'func' => $func, 'args' => $args];
        $this->setOptions(['vars' => [$name => $opts]]);
        return $this;
    }
}
