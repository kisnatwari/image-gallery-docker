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
        <div class="bg-gray-50 my-12 p-6 container max-w-7xl mx-auto">
            <span class="text-xl text-gray-700 mb-3 block">Image Showcase</span>
            <div class="grid grid-cols-4 gap-6 ">
                @foreach ($posts as $post)
                    <a href="/posts/{{ $post->id }}"
                        class="bg-white h-auto relative rounded-lg overflow-hidden shadow-md">
                        <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}"
                            class="w-full max-h-[250px] object-cover object-center min-h-[200px]">
                        <div class="p-4 pb-1">
                            <h1 class="text-lg font-bold text-slate-700 line-clamp-2">{{ $post->title }}</h1>
                            <h1 class="text-md line-clamp-2 text-slate-600">{{ $post->description }}</h1>
                            <div class="flex justify-between text-sm mt-3 text-slate-600">
                                <span>Views: {{ $post->visit_count_total }}</span>
                                <span>${{ $post->price }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </main>
</body>

</html>
