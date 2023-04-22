<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200 min-h-screen">
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <a class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out"
                            href="/dashboard">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    </div>

                </div>
                <a href="/login">Login</a>

            </div>
        </div>
    </nav>
    <main>
        <div class="bg-white my-12 p-6 container max-w-7xl mx-auto">
            <span class="text-xl text-gray-700 mb-3 block">Image Showcase</span>
            <div class="grid grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <a href="/posts/{{ $post->id }}"
                        class="bg-gray-200 relative rounded-lg overflow-hidden shadow-md">
                        <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}"
                            class="w-full h-full min-h-[150px] object-cover object-center">
                        <div
                            class="p-4 pt-5 absolute top-0 left-0 w-full h-full flex flex-col gap-2 justify-end bg-gradient-to-t from-slate-950 opacity-0 hover:opacity-100 duration-300">
                            <h2 class="font-bold text-lg text-gray-200 line-clamp-1">{{ $post->title }}</h2>
                            <p class="text-gray-300 line-clamp-2 leading-tight">{{ $post->description }}</p>
                            <p class="text-gray-400 text-sm">Total Views: {{ $post->visit_count_total }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
</body>

</html>
