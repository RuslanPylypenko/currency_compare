<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

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

    public function getRate(string $currency): float
    {
        return 2;
    }
}
