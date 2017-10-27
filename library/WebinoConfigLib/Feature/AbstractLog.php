<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Log\Writer;
use WebinoLogLib\SeverityInterface;

/**
 * Class AbstractLog
 */
abstract class AbstractLog extends AbstractFeature implements
    SeverityInterface
{
    /**
     * Application configuration key
     */
    const KEY = 'log';

    /**
     * @var Writer\AbstractWriter
     */
    protected $writer;

    /**
     * @var string
     */
    protected $writerKey;

    /**
     * @return string
     */
    protected function getWriterKey()
    {
        if (null === $this->writerKey) {
            $this->setWriterKey(get_class($this));
        }
        return $this->writerKey;
    }

    /**
     * @param string $key
     * @return $this
     */
    protected function setWriterKey($key)
    {
        $this->writerKey = (string) $key;
        return $this;
    }

    /**
     * Set priority to filter log messages
     *
     * @param int $priority
     * @return $this
     */
    public function filterPriority($priority)
    {
        $this->writer->setFilter('priority', ['priority' => $priority]);
        return $this;
    }

    /**
     * Set regular expression to filter log messages
     *
     * @param int $regex
     * @return $this
     */
    public function filterRegex($regex)
    {
        $this->writer->setFilter('regex', ['regex' => $regex]);
        return $this;
    }

    /**
     * @param string $name
     * @param array $options
     */
    protected function setProcessor($name, array $options = [])
    {
        $this->mergeArray([
            $this::KEY => [
                'processors' => [
                    $name => [
                        'name'    => $name,
                        'options' => $options,
                    ],
                ],
            ]
        ]);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->setProcessor('psrplaceholder');

        $this->mergeArray([
            $this::KEY => (new Writer([
                $this->getWriterKey() => $this->writer->toArray(),
            ]))->toArray(),
        ]);

        return parent::toArray();
    }
}
