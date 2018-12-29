<?php

namespace Webino;

/**
 * Interface RouteInterface
 * @package webino-router
 */
interface RouteInterface
{
    /**
     * Returns route class
     *
     * @return string
     */
    public function getClass(): string;

    /**
     * Returns route path
     *
     * @return string
     */
    public function getPath(): string;

    /**
     * Returns route default parameters
     *
     * @return array
     */
    public function getDefaults(): array;

    /**
     * @return array
     */
    public function getRules(): array;

    /**
     * Returns route HTTP methods
     *
     * @return array
     */
    public function getMethods(): array;

    /**
     * Returns route HTTP schemes
     *
     * @return array
     */
    public function getSchemes(): array;

    /**
     * Returns route host name
     *
     * @return string
     */
    public function getHost(): string;

    /**
     * Returns route options
     *
     * @return array
     */
    public function getOptions(): array;

    /**
     * Returns route condition expression
     *
     * @return string
     */
    public function getCondition(): string;
}
