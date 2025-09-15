<?php
namespace App\Services;

use App\Services\DTO\ParsedActorDTO;

class ActorParsingService
{
    public function parse(string $description): ParsedActorDTO
    {
        // Build prompt, call API, decode JSON, map fields, return DTO
    }
}
