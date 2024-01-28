<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

use App\Model\CurrencyRate;
use App\Services\CurrencyDataMapper\CurrencyDataMapper;
use App\Services\CurrencyDataMapper\PrivatBankDataMapper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class PrivatBankRateService extends AbstractCurrencyRateService
{
    private const API_URL = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    protected function getDataMapper(): CurrencyDataMapper
    {
        return new PrivatBankDataMapper();
    }

    protected function getApiUrl(): string
    {
        return self::API_URL;
    }
}
