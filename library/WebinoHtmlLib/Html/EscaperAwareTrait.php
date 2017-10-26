<?php

namespace WebinoHtmlLib\Html;

/**
 * Class EscaperAwareTrait
 */
trait EscaperAwareTrait
{
    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @return Escaper
     */
    protected function getEscaper()
    {
        if (null === $this->escaper) {
            $this->setEscaper(Escaper::getInstance());
        }
        return $this->escaper;
    }

    /**
     * @param Escaper $escaper
     * @return $this
     */
    public function setEscaper($escaper)
    {
        $this->escaper = $escaper;
        return $this;
    }
}
