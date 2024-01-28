<?php

namespace App\Services\CurrencyDataMapper;

use App\Model\CurrencyRate;

interface CurrencyDataMapper
{
    public function mapDataToCurrencyRate(array $data): CurrencyRate;
}