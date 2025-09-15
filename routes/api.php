<?php

use Illuminate\Support\Facades\Route;

Route::get('/actors/prompt-validation', function () {
    return response()->json(['message' => 'text_prompt']);
});
