<?php

namespace WebinoDrawLib\Feature;

use WebinoDomLib\State\AbstractSpecConfig;

/**
 * Class TableDraw
 */
class TableDraw extends AbstractSpecConfig
{
    /**
     * {@inheritdoc}
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->setOptions([
            'component' => self::class,
        ]);
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
