<?php

namespace Webino;

/**
 * Class AbstractHttpStatus
 */
interface HttpStatusInterface
{
    /**
     * Return status code
     *
     * @return int
     */
    public function getCode(): int;

    /**
     * Return status phrase
     *
     * @return string
     */
    public function getPhrase(): string;

    /**
     * Return status version
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * Send a response code header
     *
     * @return void
     */
    public function send(): void;
}
