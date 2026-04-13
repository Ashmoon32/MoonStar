<!DOCTYPE html>
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
</html>