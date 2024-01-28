<?php

declare(strict_types=1);

namespace App\Services\CurrencyDataMapper;

use App\Model\Currency;
use App\Model\CurrencyRate;

class MonobankDataMapper implements CurrencyDataMapper
{
    private const BANK_NAME = 'Monobank';

    private const EUR = 978;
    private const USD = 840;
    private const UAH = 980;

    public function mapDataToCurrencyRate(array $data): CurrencyRate
    {
        $exchangeRates = [];

        foreach ($data as $currency) {
            if ($currency['currencyCodeA'] === self::USD && $currency['currencyCodeB'] === self::UAH) {
                $exchangeRates[Currency::USD->value] = round((float) $currency['rateBuy'], 2);
            }
            if ($currency['currencyCodeA'] === self::EUR && $currency['currencyCodeB'] === self::UAH) {
                $exchangeRates[Currency::EUR->value] = round((float) $currency['rateBuy'], 2);
            }
        }

        return new CurrencyRate(self::BANK_NAME, $exchangeRates);
    }
}
