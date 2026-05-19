<?php

namespace App\Dogs\Services;

use App\Dogs\DTOs\DogDto;
use App\Dogs\Repositories\Contracts\DogRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

readonly class DogService
{
    public function __construct(
        private DogRepositoryInterface $repository,
    ) {}

    /** @param LazyCollection<int, DogDto> $breeds */
    public function store(LazyCollection $breeds): void
    {
        foreach ($breeds as $dto) {
            $this->repository->save($dto);
        }
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }
}