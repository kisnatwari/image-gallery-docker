<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl container mx-auto">
            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between mb-3">
                        <h1 class="text-2xl">Image Gallery</h1>
                        <a href="/posts/create" class="bg-gray-200 px-4 py-2 shadow-md rounded-md text-gray-700">
                            <i class="fa fa-plus"></i> &nbsp;Add Post
                        </a>
                    </div>
                    <div class="grid grid-cols-4 gap-6">
                        @foreach ($posts as $post)
                            <a href="/posts/{{ $post->id }}"
                                class="bg-white relative rounded-lg overflow-hidden shadow-md">
                                <img src="{{ Storage::url($post->image_path) }}" alt="{{ $post->title }}"
                                    class="w-full max-h-[250px] object-cover object-center min-h-[200px]">
                                <div class="p-4">
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
