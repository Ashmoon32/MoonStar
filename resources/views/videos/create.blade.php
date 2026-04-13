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

    <form action="/videos" method="POST">
    @csrf
    <div>
        <label>Video Title:</label><br>
        <input type="text" name="title">
    </div>
    <div>
        <label>Description:</label><br>
        <textarea name="description"></textarea>
        
    </div>
    <div>
        <label>File Path (temporary):</label><br>
        <input type="text" name="file_path">
    </div>
    <br>
    <button type="submit">Save Video</button>
    </form>
</body>
</html>