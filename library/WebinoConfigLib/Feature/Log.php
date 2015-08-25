<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;

/**
 * Class Log
 */
class Log extends AbstractLog
{
    /**
     * Default log file path
     */
    const DEFAULT_FILE_PATH = 'data/log/app.log';

    /**
     * @var bool
     */
    private static $useLastFilePath = false;

    /**
     * @param string $filePath
     */
    public function __construct($filePath = null)
    {
        if (null === $filePath && !$this::$useLastFilePath) {
            $filePath = $this::DEFAULT_FILE_PATH;
        } else {
            $this::$useLastFilePath = true;
        }

        $this->writer = new Writer\Stream($filePath);
        $this->setSimpleFormat();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->setWriterKey($name);
        return $this;
    }

    /**
     * Set simple message format
     *
     * @param string|null $format %timestamp% %priorityName% (%priority%): %message% %extra%
     * @return $this
     */
    public function setSimpleFormat($format = null)
    {
        $options = ['format' => $format ? $format : '%timestamp% %priorityName% (%priority%): %message%'];
        $this->writer->setFormatter('simple', $options);
        return $this;
    }

    /**
     * Set XML message format
     *
     * @return $this
     */
    public function setXmlFormat()
    {
        $this->writer->setFormatter('xml');
        return $this;
    }
}
