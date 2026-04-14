<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Video Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <form action="/videos/{{ $video->id }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <x-input-label value="Current Thumbnail" class="mb-2" />
                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" 
                             class="w-48 rounded-lg border shadow-sm" alt="Preview">
                    </div>

                    <div>
                        <x-input-label for="title" :value="__('Video Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" 
                                     :value="old('title', $video->title)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" 
                                  class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                  rows="5" required>{{ old('description', $video->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
                        
                        <a href="/videos" class="text-sm text-gray-600 hover:text-gray-900 underline">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>