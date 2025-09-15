<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:actor_submissions,email'],
            'actor_description' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email has already been used.',
        ];
    }
}
