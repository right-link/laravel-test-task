@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold tracking-tight text-white">Submissions</h1>
        <a href="{{ route('actors.create') }}"
           class="inline-flex items-center rounded-md bg-gray-700 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600 transition">
            ← Back to form
        </a>
    </div>

    <div class="overflow-x-auto rounded-lg shadow-xl">
        <table class="min-w-full bg-gray-800 text-gray-300">
            <thead class="bg-gray-700">
            <tr>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">First Name</th>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">Last Name</th>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">Address</th>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">Gender</th>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">Height</th>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">Weight</th>
                <th class="text-left p-4 font-semibold text-sm uppercase tracking-wider">Age</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
            @forelse($submissions as $s)
                <tr>
                    <td class="p-4 whitespace-nowrap">{{ $s->first_name }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $s->last_name }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $s->address }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $s->gender ?? '—' }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $s->height ?? '—' }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $s->weight ?? '—' }}</td>
                    <td class="p-4 whitespace-nowrap">{{ $s->age ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500 italic">No submissions yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
