<?php
namespace App\Services\DTO;

class ParsedActorDTO
{
    public function __construct(
        public ?string $first_name,
        public ?string $last_name,
        public ?string $address,
        public ?float $height,
        public ?float $weight,
        public ?string $gender,
        public ?int $age,
    ) {}

    public function hasRequired(): bool
    {
        return $this->first_name && $this->last_name && $this->address;
    }
}
