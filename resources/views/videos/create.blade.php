<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Videos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 60%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #388bcf;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #35637d;
        }
    </style>
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