<?php

namespace App\Dogs\DTOs;

readonly class DogDto
{
    public function __construct(
        public int $externalId,
        public string $name,
        public ?string $temperament,
        public ?string $weightMetric,
        public ?string $weightImperial,
        public ?string $lifeSpan,
    ) {}

    public static function fromApiResponse(array $data): self
    {
        return new self(
            externalId: $data['id'],
            name: $data['name'],
            temperament: $data['temperament'] ?? null,
            weightMetric: $data['weight']['metric'] ?? null,
            weightImperial: $data['weight']['imperial'] ?? null,
            lifeSpan: $data['life_span'] ?? null,
        );
    }
}
