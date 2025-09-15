<?php

it('returns static JSON from prompt-validation endpoint', function () {
    $this->getJson('/api/actors/prompt-validation')
        ->assertOk()
        ->assertExactJson(['message' => 'text_prompt']);
});
