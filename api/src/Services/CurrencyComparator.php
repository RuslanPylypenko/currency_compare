<?php

declare(strict_types=1);

namespace App\Services;

use App\Event\CurrencyComparisonEvent;
use App\Model\Currency;
use App\Model\CurrencyRate;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
        foreach (Currency::currencies() as $currency) {
            if(abs($first->getRate($currency->value) - $second->getRate($currency->value)) > $threshold) {
                $thresholdReached[$currency->value] = [$first, $second];
            }
        }

        if(!empty($thresholdReached)) {
            $this->dispatcher->dispatch(new CurrencyComparisonEvent($thresholdReached, $threshold));
        }
    }
}
