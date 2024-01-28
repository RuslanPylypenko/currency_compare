<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

use App\Model\CurrencyRate;
use App\Services\CurrencyDataMapper\CurrencyDataMapper;
use App\Services\CurrencyDataProvider;

abstract class AbstractCurrencyRateService
{
    public function __construct(
        private readonly CurrencyDataProvider $currencyDataProvider,
    ) {
    }

    public function getCurrencyRates(): CurrencyRate
    {
        $data = $this
            ->currencyDataProvider
            ->fetchDataFromAPI($this->getApiUrl());

        return $this
            ->getDataMapper()
            ->mapDataToCurrencyRate($data);
    }

    abstract protected function getDataMapper(): CurrencyDataMapper;

    abstract protected function getApiUrl(): string;
}
