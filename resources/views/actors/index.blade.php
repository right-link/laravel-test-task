@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Submissions</h1>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full">
            <thead class="bg-gray-100">
            <tr>
                <th class="text-left p-3">First Name</th>
                <th class="text-left p-3">Address</th>
                <th class="text-left p-3">Gender</th>
                <th class="text-left p-3">Height</th>
            </tr>
            </thead>
            <tbody>
            @forelse($submissions as $s)
                <tr class="border-t">
                    <td class="p-3">{{ $s->first_name }}</td>
                    <td class="p-3">{{ $s->address }}</td>
                    <td class="p-3">{{ $s->gender ?? '—' }}</td>
                    <td class="p-3">{{ $s->height ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-3 text-gray-600">No submissions yet.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
