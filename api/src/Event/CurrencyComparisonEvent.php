<?php

declare(strict_types=1);

namespace App\Event;

use App\Model\CurrencyRate;
use Symfony\Contracts\EventDispatcher\Event;

class CurrencyComparisonEvent extends Event
{
    /**
     * @param array<string, array{CurrencyRate, CurrencyRate}> $thresholdReached
     * @param float $threshold
     */
    public function __construct(
        private readonly array $thresholdReached,
        private readonly float $threshold,
    ){
    }

    /**
     * @return array<string, array{CurrencyRate, CurrencyRate}>
     */
    public function getThresholdReached(): array
    {
        return $this->thresholdReached;
    }

    public function getThreshold(): float
    {
        return $this->threshold;
    }
}