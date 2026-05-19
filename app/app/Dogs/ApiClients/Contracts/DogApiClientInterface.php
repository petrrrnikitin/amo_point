<?php

namespace App\Dogs\ApiClients\Contracts;

interface DogApiClientInterface
{
    public function fetchBreeds(int $page, int $limit): array;
}