<?php

declare(strict_types=1);

namespace App\Services;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CurrencyDataProvider
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function fetchDataFromAPI(string $apiUrl): array
    {
        try {
            $response = $this->httpClient->request('GET', $apiUrl);

            if ($response->getStatusCode() === Response::HTTP_TOO_MANY_REQUESTS) {
                throw new RuntimeException('Too many requests, please try again later...');
            }

            if ($response->getStatusCode() !== Response::HTTP_OK) {
                throw new RuntimeException('Something wrong...');
            }

            return $response->toArray();
        } catch (TransportExceptionInterface) {
            return [];
        }
    }
}
