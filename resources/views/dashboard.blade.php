<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-2xl">Image Gallery (Your Posts)</h1>
                        <a href="/posts/create" class="bg-gray-200 px-4 py-2 shadow-md rounded-md text-gray-700">
                            <i class="fa fa-plus"></i> &nbsp;Add Post
                        </a>
                    </div>
                    <div class="grid grid-cols-4 gap-6">
                        @foreach ($posts as $post)
                            <a href="/posts/{{ $post->id }}"
                                class="bg-gray-200 relative rounded-lg overflow-hidden shadow-md">
                                <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover object-center">
                                <div
                                    class="p-4 pt-5 absolute top-0 left-0 w-full h-full flex flex-col gap-2 justify-end bg-gradient-to-t from-slate-950 opacity-0 hover:opacity-100 duration-300">
                                    <h2 class="font-bold text-lg text-gray-200 line-clamp-1">{{ $post->title }}</h2>
                                    <p class="text-gray-300 line-clamp-2 leading-tight">{{ $post->description }}</p>
                                    <p class="text-gray-400 text-sm">Total Views: {{ $post->visit_count_total }}</p>
                                </div>
                            </a>
                        @endforeach

                    </div>
                    @if (session('success'))
                        <div class="bg-green-700 success_alert text-white p-5 my-4 rounded-lg">
                            {{ session('success') }}
                        </div>
                        <script>
                            setTimeout(() => {
                                document.querySelector(".success_alert").remove();
                            }, 3500);
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
