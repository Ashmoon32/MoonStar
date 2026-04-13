<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Videos</title>
</head>
<body>
    <h1>Upload a new video</h1>

    <form action="/videos" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Video Title:</label><br>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label>Description:</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <label>Select Video File:</label><br>
        <input type="file" name="video_file">
        @error('file_path')
            <p style="color: red;">{{ $message }}</p>
        @enderror
    </div>
    <br>
    <button type="submit">Upload Video</button>
    </form>
</body>
</html>