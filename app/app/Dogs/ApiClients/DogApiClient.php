<?php

namespace App\Dogs\ApiClients;

use App\Dogs\ApiClients\Contracts\DogApiClientInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

readonly class DogApiClient implements DogApiClientInterface
{
    public function __construct(
        private string $baseUrl,
        private string $apiKey,
    ) {}

    public function fetchBreeds(int $page, int $limit): array
    {
        try {
            return Http::baseUrl($this->baseUrl)
                ->withHeader('x-api-key', $this->apiKey)
                ->timeout(10)
                ->retry(3, 500)
                ->get('/breeds', ['limit' => $limit, 'page' => $page])
                ->throw()
                ->json();
        } catch (ConnectionException $e) {
            throw new RuntimeException('Dog API unreachable: ' . $e->getMessage(), previous: $e);
        } catch (RequestException $e) {
            throw new RuntimeException('Dog API request failed: ' . $e->response->status(), previous: $e);
        }
    }
}