<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
        parent::__construct();

        if (null === $filePath && !$this::$useLastFilePath) {
            $filePath = $this::DEFAULT_FILE_PATH;
        } else {
            $this::$useLastFilePath = true;
        }

        $this->writer = new Writer\Stream($filePath);
        $this->setWriterKey(basename($filePath));
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
