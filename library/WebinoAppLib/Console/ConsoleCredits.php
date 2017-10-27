<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Service\Credits;
use WebinoConfigLib\Feature\Route\ConsoleRoute;

/**
 * Class ConsoleCredits
 */
class ConsoleCredits extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(ConsoleRoute $route)
    {
        $route
            ->setPath('credits')
            ->setTitle('Show credits');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        $cli = $event->getCli();
        $cli->flank('Credits')->br();

        /** @var Credits $credits */
        $credits = $event->getApp()->get(Credits::class);

        // third-party
        foreach ($credits->getCredits(__DIR__ . '/../../../vendor') as $item) {
            $cli->bold($item[0])->whisper($item[1]);
        }

        $note = 'Webino™ is brought to you thanks to authors and contributors '
              . 'of above third-party libraries also.';

        $cli
            ->border()
            ->comment($note)
            ->border()->br()
            ->bold()->inline(Credits::VENDOR_COPYRIGHT)
            ->out(' (' . Credits::VENDOR_URL . ')')
            ->bold()->inline('Author: ')
            ->whisper()->inline(Credits::AUTHOR_NAME)
            ->out(' (' . Credits::AUTHOR_URL . ')')
            ->br();
    }
}
