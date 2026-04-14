<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Videos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/videos/create" class="text-blue-500 underline">Upload New Video</a>
            <hr class="my-4">
            <br>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($videos as $video)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="/videos/{{ $video->id }}">
                            @if ($video->thumbnail_path)
                                <img src="{{ asset('storage/' . $video->thunbnail_path) }}" alt="Thumbnail" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">No Thumbnail</div>
                            @endif
                        </a>

                        <div class="p-4">
                            <h3 class="font-bold text-lg">{{ $video->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $video->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
                    
            </div>
        </div>
    </div>
</x-app-layout>