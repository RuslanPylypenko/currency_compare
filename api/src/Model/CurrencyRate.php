<?php

declare(strict_types=1);

namespace App\Model;

class CurrencyRate
{
    public function __construct(
        private readonly string $bank,
        private readonly array $rates,
    ) {
    }

    public function getBank(): string
    {
        return $this->bank;
    }

    public function getRate(Currency $currency): float
    {
        return $this->rates[$currency->value];
    }
}
