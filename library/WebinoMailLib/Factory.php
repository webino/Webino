<?php

namespace WebinoMailLib;

use WebinoConfigLib\Feature\FileMailer;
use Zend\Mail\Transport\Factory as TransportFactory;

/**
 * Class Factory
 */
final class Factory
{
    /**
     * Create a mailer
     *
     * @param array|\Traversable $options
     * @return MailerInterface
     */
    public function create($options = null)
    {

        $transport = TransportFactory::create($this->resolveTransportOptions($options));

        $mailer = new Mailer;

        $mailer->setTransport($transport);

        // TODO config message

        return $mailer;
    }

    /**
     * @param array|\Traversable $options
     * @return array|\Traversable
     */
    private function resolveTransportOptions($options = null)
    {
        // TODO optional
        $defaultTransport = FileMailer::class;

        // TODO constants
        if (null !== $options && isset($options['transports'])) {
            /** @var \WebinoAppLib\Application\Config $transports */
            $transports = $options['transports'];

            if (!empty($transports[$defaultTransport])) {
                return $transports[$defaultTransport];
            } else {
                return current($transports->toArray());
            }
        }

        return [];
    }
}
