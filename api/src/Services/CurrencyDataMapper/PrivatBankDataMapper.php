<?php

declare(strict_types=1);

namespace App\Services\CurrencyDataMapper;

use App\Model\Currency;
use App\Model\CurrencyRate;

class PrivatBankDataMapper implements CurrencyDataMapper
{
    private const BANK_NAME = 'Privatbank';

    private const EUR = 'EUR';
    private const USD = 'USD';
    private const UAH = 'UAH';

    public function mapDataToCurrencyRate(array $data): CurrencyRate
    {
        $exchangeRates = [];

        foreach ($data as $currency) {
            if ($currency['ccy'] === self::USD && $currency['base_ccy'] === self::UAH) {
                $exchangeRates[Currency::USD->value] = round((float) $currency['buy'], 2);
            }
            if ($currency['ccy'] === self::EUR && $currency['base_ccy'] === self::UAH) {
                $exchangeRates[Currency::EUR->value] = round((float) $currency['buy'], 2);
            }
        }

        return new CurrencyRate(self::BANK_NAME, $exchangeRates);
    }
}
