<?php

namespace App\Dogs\Repositories\Contracts;

use App\Dogs\DTOs\DogDto;
use Illuminate\Support\Collection;

interface DogRepositoryInterface
{
    public function save(DogDto $dto): void;

    /** @return Collection<int, \App\Dogs\Models\Dog> */
    public function getAll(): Collection;
}