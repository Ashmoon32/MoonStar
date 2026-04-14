<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Streamer Dashboard') }}
            </h2>
            <a href="/videos/create"
                class="bg-indigo-600 hover:bg-indigo-700 text-black font-bold py-2 px-4 rounded transition">
                + Upload New Video
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('status'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($videos as $video)
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl flex flex-col transition hover:shadow-2xl">

                        <a href="/videos/{{ $video->id }}" class="block group overflow-hidden rounded-t-xl">
                            <div class="aspect-video w-full overflow-hidden bg-gray-200 relative">
                                @if ($video->thumbnail_path)
                                    <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="Thumbnail"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400 italic text-xs">
                                        No Preview Available
                                    </div>
                                @endif

                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/20">
                                    <div class="bg-white/90 p-3 rounded-full shadow-lg">
                                        <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M6.3 2.841A1.5 1.5 0 004 4.11v11.78a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.841z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="p-5 flex-grow">
                            <h3 class="font-extrabold text-xl text-gray-900 truncate mb-1" title="{{ $video->title }}">
                                {{ $video->title }}
                            </h3>
                            <p class="text-sm text-gray-500 font-medium">
                                By {{ $video->user->name }} • {{ $video->created_at->diffForHumans() }}
                            </p>
                            <p class="text-gray-600 text-sm mt-3 line-clamp-2">
                                {{ Str::limit($video->description, 80) }}
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 flex justify-between items-center gap-2">
                            <a href="/videos/{{ $video->id }}"
                                class="text-indigo-600 font-bold text-sm hover:underline uppercase">Watch Now</a>

                            @if ($video->user_id === auth()->id())
                                <div class="flex gap-4">

                                    <a href="/videos/{{ $video->id }}/edit" class="text-gray-600 font-bold text-sm hover:text-gray-900 uppercase" style="margin-top: 4px;">Edit</a>

                                    <form action="/videos/{{ $video->id }}" method="POST"
                                        onsubmit="return confirm('Ready to delete this? It cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 font-bold text-sm hover:text-red-700 uppercase">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if($videos->isEmpty())
                <div class="text-center bg-white p-20 rounded-xl shadow-inner">
                    <p class="text-gray-400 text-xl">The stage is empty... upload a video to start the stream!</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>