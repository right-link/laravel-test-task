<?php

use App\Models\ActorSubmission;
use Illuminate\Support\Facades\Http;

it('GET / shows form with helper text', function () {
    $this->get(route('actors.create'))
        ->assertOk()
        ->assertSee('Please enter your first name and last name, and also provide your address.');
});

it('rejects invalid input', function () {
    $this->withoutMiddleware()
        ->post(route('actors.store'), [
            'email' => '',
            'actor_description' => '',
        ])->assertSessionHasErrors(['email', 'actor_description']);
});

it('rejects duplicate email', function () {
    ActorSubmission::create([
        'email' => 'a@example.com',
        'actor_description' => 'desc',
    ]);

    $this->withoutMiddleware()
        ->post(route('actors.store'), [
            'email' => 'a@example.com',
            'actor_description' => 'John Doe from 123 Main St.',
        ])->assertSessionHasErrors(['email']);
});

it('shows parsing error when required fields missing', function () {
    Http::fake([
        'api.openai.com/*' => Http::response([
            'choices' => [[
                'message' => ['content' => json_encode([
                    'first_name' => null, 'last_name' => null, 'address' => null,
                    'height' => null, 'weight' => null, 'gender' => null, 'age' => null,
                ])]
            ]]
        ], 200),
    ]);

    $this->withoutMiddleware()
        ->post(route('actors.store'), [
            'email' => 'b@example.com',
            'actor_description' => 'Tall person.',
        ])->assertSessionHasErrors([
            'actor_description' => 'Please add first name, last name, and address to your description.',
        ]);
});

it('saves submission and redirects to index on success', function () {
    Http::fake([
        'api.openai.com/*' => Http::response([
            'choices' => [[
                'message' => ['content' => json_encode([
                    'first_name' => 'John', 'last_name' => 'Doe', 'address' => '123 Main St',
                    'height' => 180, 'weight' => 75, 'gender' => 'male', 'age' => 35,
                ])]
            ]]
        ], 200),
    ]);

    $resp = $this->withoutMiddleware()
        ->post(route('actors.store'), [
            'email' => 'c@example.com',
            'actor_description' => 'John Doe, 123 Main St, 180cm, 75kg, male, 35.',
        ]);

    $resp->assertRedirect(route('actors.index'));
    $this->assertDatabaseHas('actor_submissions', [
        'email' => 'c@example.com',
        'first_name' => 'John',
        'address' => '123 Main St',
    ]);
});

it('GET /actors shows table columns', function () {
    $this->get(route('actors.index'))
        ->assertOk()
        ->assertSee('First Name')
        ->assertSee('Address')
        ->assertSee('Gender')
        ->assertSee('Height');
});
