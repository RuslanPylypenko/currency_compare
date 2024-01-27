<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

interface CurrencyRateApiClient
{
    public function getRates(): CurrencyRate;
}