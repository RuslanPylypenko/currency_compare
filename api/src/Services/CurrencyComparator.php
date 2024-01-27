<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\CurrencyRate\CurrencyRate;

class CurrencyComparator
{
    public function __construct(
        private readonly EventDispatcherInterface $dispatcher,
    ) {
    }

    public function compare(
        CurrencyRate $first,
        CurrencyRate $second,
        float $threshold
    ): void {
        $thresholdReached = [];
        foreach (['USD', 'EUR'] as $currency) {
            if(abs($first->getRate($currency) - $second->getRate($currency)) > $threshold) {
                $thresholdReached[$currency] = [$first, $second];
            }
        }

    }
}
