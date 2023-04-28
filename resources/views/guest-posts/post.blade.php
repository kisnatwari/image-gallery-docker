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
        <div class="max-w-7xl mx-auto container">
            <div class="bg-white my-12 p-6 overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}"
                    class="w-full h-auto max-h-[800px] object-contain">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">{{ $post->title }}</h3>
                    <p class="mt-2 text-gray-600">{{ $post->description }}</p>
                    <div class="text-md text-slate-500 font-bold mt-4">
                        Post Created: {{ $post->created_at->diffForHumans() }}
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span class="text-gray-600">{{ $post->visit_count_total }} views</span>
                        </div>
                        @if (Auth::check() && $post->user_id === Auth::user()->id)
                            <form action="/posts/{{ $post->image_id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        @endif
                    </div>
                    <div class="my-4 flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-10 w-10 rounded-full" src="https://www.gravatar.com/avatar?d=mp"
                                alt="{{ $post->user->name }} Avatar">
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">{{ $post->user->name }}</div>
                            <div class="text-sm text-gray-500">{{ $post->user->email }}</div>
                        </div>
                    </div>
                    <fieldset class="border-t-2 pt-3 mb-3">
                        <div>
                            <h3 class="text-2xl text-gray-500">Login to comment...</h3>
                            @foreach ($post->comments as $comment)
                                <div class="bg-gray-100 rounded-lg p-3 my-2 relative">
                                    <div class="flex justify-start gap-3">
                                        <img class="h-10 rounded-full"
                                            src="https://www.gravatar.com/avatar/{{ md5($comment->email) }}?d=mp"
                                            alt="{{ $comment->name }}">
                                        <div>
                                            <div class="flex justify-start flex-wrap items-baseline gap-2">
                                                <span class="text-gray-800 text-xl">{{ $comment->user_name }}</span>
                                                <span
                                                    class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="text-gray-700">{{ $comment->comment }}</div>
                                        </div>
                                    </div>
                                    @if (auth()->check() && auth()->user()->role == 'admin')
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                            class="absolute top-0 right-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                            @if ($errors->any())
                                <div class="bg-red-50 text-red-500 p-5 my-4 rounded-lg">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
