<?php

declare(strict_types=1);

namespace App\Event;

use App\Services\CurrencyRate\CurrencyRate;
use Symfony\Contracts\EventDispatcher\Event;

class CurrencyComparisonEvent extends Event
{
    public function __construct(
        private readonly array $thresholdReached
    ){
    }

    /**
     * @return array<string, array<CurrencyRate, CurrencyRate>>
     */
    public function getThresholdReached(): array
    {
        return $this->thresholdReached;
    }
}