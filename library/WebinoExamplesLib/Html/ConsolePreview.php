<?php

namespace WebinoExamplesLib\Html;

use WebinoHtmlLib\Html;

/**
 * Class ConsolePreview
 */
final class ConsolePreview extends ScrollBox
{
    /**
     * @var string
     */
    private $label;

    /**
     * @param string $imgSrc Console preview image src
     * @param string $label Console preview label
     */
    public function __construct($imgSrc, $label = 'Console preview:')
    {
        parent::__construct(new Html\Img($imgSrc));
        $this->label = $label;

        $this->setStyle([
            'overflow-x' => 'hidden',
            'padding'    => '0',
            'background' => '#300a24',
        ]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (new Html\Text($this->label)) . parent::__toString();
    }
}
