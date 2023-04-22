<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-2xl">Image Gallery (Trash)</h1>
                    </div>

                    @if (count($posts))
                        <table class="w-full text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                        <td class="py-2">
                                            <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}"
                                                class="mx-auto rounded-lg max-w-[70px] max-h-[70px]">
                                        </td>
                                        <td class="py-2">{{ $post->title }}</td>
                                        <td class="py-2">{{ $post->description }}</td>
                                        <td class="py-2">
                                            <div class="flex justify-center space-x-4">
                                                <a href="{{ route('posts.forceDelete', ['id' => $post->id]) }}"
                                                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                                    Force Delete
                                                </a>
                                                <a href="{{ route('posts.restore', ['id' => $post->id]) }}"
                                                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">
                                                    Restore
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p> No Trashed Data here... Come back later </p>
                    @endif

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
