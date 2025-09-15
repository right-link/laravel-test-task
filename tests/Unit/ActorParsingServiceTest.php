<?php

use App\Services\ActorParsingService;
use Illuminate\Support\Facades\Http;

it('maps valid JSON to DTO', function () {
    Http::fake([
        'api.openai.com/*' => Http::response([
            'choices' => [[
                'message' => ['content' => json_encode([
                    'first_name' => 'Jane', 'last_name' => 'Doe', 'address' => '456 Oak Ave',
                    'height' => 165.5, 'weight' => 60.2, 'gender' => 'female', 'age' => 28,
                ])]
            ]]
        ], 200),
    ]);

    $service = new ActorParsingService();
    $dto = $service->parse('Some description');

    expect($dto)->not->toBeNull();
    expect($dto->first_name)->toBe('Jane');
    expect($dto->last_name)->toBe('Doe');
    expect($dto->address)->toBe('456 Oak Ave');
    expect($dto->height)->toBe(165.5);
    expect($dto->weight)->toBe(60.2);
    expect($dto->gender)->toBe('female');
    expect($dto->age)->toBe(28);
    expect($dto->hasRequired())->toBeTrue();
});

it('handles non-JSON content returning null fields', function () {
    Http::fake([
        'api.openai.com/*' => Http::response([
            'choices' => [[
                'message' => ['content' => 'not json']
            ]]
        ], 200),
    ]);

    $service = new ActorParsingService();
    $dto = $service->parse('Another description');

    expect($dto)->not->toBeNull();
    expect($dto->first_name)->toBeNull();
    expect($dto->last_name)->toBeNull();
    expect($dto->address)->toBeNull();
    expect($dto->height)->toBeNull();
    expect($dto->weight)->toBeNull();
    expect($dto->gender)->toBeNull();
    expect($dto->age)->toBeNull();
    expect($dto->hasRequired())->toBeFalse();
});
