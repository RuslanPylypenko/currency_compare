<?php

declare(strict_types=1);

namespace App\Services\CurrencyRate;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PrivatBankApiClient implements CurrencyRateApiClient
{
    private const API_URL = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

    private const EUR = 'EUR';
    private const USD = 'USD';
    private const UAH = 'UAH';

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
                if ($currency['ccy'] === self::USD && $currency['base_ccy'] === self::UAH) {
                    $exchangeRates['USD'] = (float) $currency['buy'];
                }
                if ($currency['ccy'] === self::EUR && $currency['base_ccy'] === self::UAH) {
                    $exchangeRates['EUR'] = (float) $currency['buy'];
                }
            }

        } catch (TransportExceptionInterface) {
        }

      //  dd($exchangeRates);

        return new CurrencyRate('Privatbank', $exchangeRates);
    }
}
