<?php

namespace WebinoAppLib\Response;

use WebinoAppLib\Event\DispatchEvent;
use Zend\Http\Response\Stream;

/**
 * Class StreamResponse
 */
class StreamResponse extends Stream implements
    OnResponseInterface
{
    /**
     * @var int
     */
    protected $contentLength = -1;

    /**
     * @var string
     */
    protected $fileName;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @param string|resource $pathOrResource
     */
    public function __construct($pathOrResource)
    {
        if (is_resource($pathOrResource)) {
            $this->setStream($pathOrResource);
        } else {
            $this->filePath = $pathOrResource;
            $this->setFileName(basename($pathOrResource));
            $this->setContentLength(filesize($pathOrResource));
        }
    }

    /**
     * Handle response
     *
     * @param DispatchEvent $event
     */
    public function onResponse(DispatchEvent $event)
    {
        $this->filePath and $this->setStream($event->getApp()->file()->readStream($this->filePath));
    }

    /**
     * Set the response stream
     *
     * @param resource|callable $stream
     * @return Stream
     */
    public function setStream($stream)
    {
        return parent::setStream($stream);
    }

    /**
     * @param string|null $default
     * @return string
     */
    protected function getFileName($default = null)
    {
        if (empty($this->fileName)) {
            return $default;
        }
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @param string|null $name
     * @return $this
     */
    public function setForceDownload($name = null)
    {
        $this->getHeaders()->addHeaders([
            'Content-Disposition' => 'attachment; filename="' . $this->getFileName($name) .'"',
            'Content-Length'      => $this->getContentLength(),
            'Content-Type'        => 'application/force-download',
        ]);

        return $this;
    }
}
