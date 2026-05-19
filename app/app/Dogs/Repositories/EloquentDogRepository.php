<?php

namespace App\Dogs\Repositories;

use App\Dogs\DTOs\DogDto;
use App\Dogs\Models\Dog;
use App\Dogs\Repositories\Contracts\DogRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentDogRepository implements DogRepositoryInterface
{
    public function save(DogDto $dto): void
    {
        Dog::firstOrCreate(
            ['external_id' => $dto->externalId],
            [
                'name' => $dto->name,
                'temperament' => $dto->temperament,
                'weight_metric' => $dto->weightMetric,
                'weight_imperial' => $dto->weightImperial,
                'life_span' => $dto->lifeSpan,
            ]
        );
    }

    public function getAll(): Collection
    {
        return Dog::orderBy('name')->get();
    }
}