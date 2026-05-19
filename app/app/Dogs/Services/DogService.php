<?php

namespace App\Dogs\Services;

use App\Dogs\DTOs\DogDto;
use App\Dogs\Repositories\Contracts\DogRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\LazyCollection;

readonly class DogService
{
    public function __construct(
        private DogRepositoryInterface $repository,
    ) {}

    /** @param LazyCollection<int, DogDto> $breeds */
    public function store(LazyCollection $breeds): void
    {
        $breeds->each(function (DogDto $dogDto): void {
           $this->repository->save($dogDto);
        });
        foreach ($breeds as $dto) {
            $this->repository->save($dto);
        }
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
}
