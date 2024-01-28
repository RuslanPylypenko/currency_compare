<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

use App\Services\CurrencyDataMapper\CurrencyDataMapper;
use App\Services\CurrencyDataMapper\MonobankDataMapper;
use App\Services\CurrencyDataProvider;

class MonoBankRateService extends AbstractCurrencyRateService
{
    private const API_URL = 'https://api.monobank.ua/bank/currency';

    protected function getDataMapper(): CurrencyDataMapper
    {
       return new MonobankDataMapper();
    }

    protected function getApiUrl(): string
    {
        return self::API_URL;
    }
}
