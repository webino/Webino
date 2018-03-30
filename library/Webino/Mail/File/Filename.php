<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Mail\File;

use Webino\Base\Util\SingletonTrait;

/**
 * Class Filename
 */
class Filename
{
    use SingletonTrait;

    /**
     * @var string
     */
    private $lastTime;

    /**
     * @return string
     */
    public function __invoke() : string
    {
        do {
            $time = (string) microtime(true);
        } while($this->lastTime === $time && (usleep(1) || true));

        $this->lastTime = $time;
        return 'Mail_' . $time . '.eml';
    }

    /**
     * Returns name for a mail file
     */
    public static function create() : string
    {
        return static::getInstance()->__invoke();
    }
}
