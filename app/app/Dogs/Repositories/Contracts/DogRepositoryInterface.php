<?php

namespace App\Dogs\Repositories\Contracts;

use App\Dogs\DTOs\DogDto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface DogRepositoryInterface
{
    public function save(DogDto $dto): void;

    public function paginate(int $perPage): LengthAwarePaginator;
}