<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

class MonoBankApiClient implements CurrencyRateApiClient
{
    public function getRates(): CurrencyRate
    {
       return new CurrencyRate('Mono', []);
    }
}
