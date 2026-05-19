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
}
