<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actor App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen flex flex-col">
<header class="block w-full bg-white/5">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-extrabold tracking-tight text-white">
            <a href="{{ route('actors.create') }}">Actor App</a>
        </div>
        <ul class="hidden md:flex space-x-8 font-semibold">
            <li><a href="{{ route('actors.create') }}" class="text-white hover:text-gray-200 transition duration-300">Form</a></li>
            <li><a href="{{ route('actors.index') }}" class="text-white hover:text-gray-200 transition duration-300">Submissions</a></li>
        </ul>

    </nav>
</header>
<main class="isolate px-6 py-10 sm:py-12 lg:px-8 flex-1">
    <div class="mx-auto max-w-3xl">
        @if (session('status'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </div>
</main>
</body>
</html>
