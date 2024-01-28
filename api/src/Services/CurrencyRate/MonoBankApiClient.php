<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MonoBankApiClient implements CurrencyRateApiClient
{
    private const API_URL = 'https://api.monobank.ua/bank/currency';

    private const EUR = 978;
    private const USD = 840;
    private const UAH = 980;

    public function __construct(
        private readonly HttpClientInterface $client,
    ) {
    }

    public function getRates(): CurrencyRate
    {
        $exchangeRates = [];

        try {
            $response = $this->client->request('GET', self::API_URL);

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new \Exception('Can`t fetch data');
            }

            foreach ($response->toArray() as $currency) {
                if ($currency['currencyCodeA'] === self::USD && $currency['currencyCodeB'] === self::UAH) {
                    $exchangeRates['USD'] = $currency['rateBuy'];
                }
                if ($currency['currencyCodeA'] === self::EUR && $currency['currencyCodeB'] === self::UAH) {
                    $exchangeRates['EUR'] = $currency['rateBuy'];
                }
            }

        } catch (TransportExceptionInterface) {
        }

        return new CurrencyRate('Monobank', $exchangeRates);
    }
}
