<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

class PrivatBankApiClient implements CurrencyRateApiClient
{
    public function getRates(): CurrencyRate
    {
        return new CurrencyRate('Privat', ['USD' => 36.7, 'EUR' => 41.4]);
    }
}
