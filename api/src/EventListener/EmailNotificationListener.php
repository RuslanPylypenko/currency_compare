<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Event\CurrencyComparisonEvent;
use RuntimeException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

#[AsEventListener(event: CurrencyComparisonEvent::class, method: 'process')]
class EmailNotificationListener
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) {
    }

    public function process(CurrencyComparisonEvent $event): void
    {
        $message = (new TemplatedEmail())
            ->to('user@app.com')
            ->subject('Threshold Reached')
            ->htmlTemplate('currency/threshold_reached.html.twig')
            ->context([
                'thresholdReached' => $event->getThresholdReached()
            ]);

        try {
            $this->mailer->send($message);
        } catch (TransportExceptionInterface) {
            throw new RuntimeException('Unable to send email.');
        }
    }
}
