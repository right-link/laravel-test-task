@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Submit Actor Description</h1>
    <form method="POST" action="{{ route('actors.store') }}" class="space-y-4 bg-white p-4 rounded shadow">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required>
            @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Actor Description</label>
            <textarea name="actor_description" rows="5" class="w-full border rounded p-2" required>{{ old('actor_description') }}</textarea>
            @error('actor_description')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
            <p class="text-gray-600 text-sm mt-2">
                Please enter your first name and last name, and also provide your address.
            </p>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
    </form>
@endsection
