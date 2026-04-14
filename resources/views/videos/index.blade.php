{{-- Just commenting out the old code for learning purposes. --}} 

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoonStar Video Streaming Application</title>
</head>
<body>
    <h1>Welcome to our <b><i>MoonStar</i></b>, <br>Video Streaming Application..</h1>
    
    <h3>All Videos</h3>

    <ul>
        @foreach ($videos as $video )
            <li>
                <strong>{{  $video->title }}</strong> <br>
                {{ $video->description }} <br> 
                <small>Path: {{ $video->file_path }}</small>
                <a href="/videos/{{ $video->id }}">View</a>
                <p>Uploaded by: {{ $video->user->name }}</p>
            </li>
            <hr>
        @endforeach
    </ul>
</body>
</html> --}}

{{--  ======================================================================================================== --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Videos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="/videos/create" class="text-blue-500 underline">Upload New Video</a>
                <hr class="my-4">
                <br>

                @foreach ($videos as $video )
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">{{ $video->title }}</h3>
                        <p>Uploaded by: {{ $video->user->name }}</p>
                        <a href="/videos/{{ $video->id }}" class="text-blue-500">Watch Now</a>
                    </div>
                    <hr>
                @endforeach
                    
            </div>
        </div>
    </div>
</x-app-layout>