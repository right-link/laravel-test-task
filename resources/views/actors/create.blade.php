@extends('layouts.app')

@section('content')
    <style>
        /* Fix for browser autofill styles */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #2d3748 inset !important; /* bg-gray-700 color */
            -webkit-text-fill-color: #f7fafc !important; /* text-white color */
        }
    </style>

    <h1 class="text-2xl font-semibold mb-4 text-white">Submit Actor Description</h1>
    <form method="POST" action="{{ route('actors.store') }}"
          class="rounded-lg p-8 bg-gray-800 shadow-xl">
        @csrf

        <div class="mb-6">
            <label for="email" class="block text-sm font-medium mb-1 text-gray-300">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email') }}"
                   class="w-full bg-gray-700 text-white rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 placeholder-gray-400"
                   required>
            @error('email')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="actor_description" class="block text-sm font-medium mb-1 text-gray-300">Actor Description</label>
            <textarea name="actor_description" id="actor_description" rows="5"
                      class="w-full bg-gray-700 text-white rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 placeholder-gray-400"
                      required>{{ old('actor_description') }}</textarea>

            @error('actor_description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror

            <p class="text-gray-400 text-sm mt-2">
                Please enter your first name and last name, and also provide your address.
            </p>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Submit
            </button>
        </div>
    </form>
@endsection
