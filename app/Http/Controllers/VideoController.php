<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $allvideos = Video::all();
        return view('videos.index', [
            "videos" => $allvideos
        ]);
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'video_file' => 'required|file|mimetypes:video/mp4,video/mpeg,video/quicktime,video/x-msvideo,video/x-matroska,video/webm|max:50000',
        ]);

        $videoPath = null;
        $thumbnailName = null;

        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('videos', 'public');
            $fullVideoPath = storage_path('app/public/' . $videoPath);

            $thumbnailName = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';
            $fullThumbnailPath = storage_path('app/public/' . $thumbnailName);

            try {
                $ffmpeg = \FFMpeg\FFMpeg::create([
                    'ffmpeg.binaries' => env('FFMPEG_BINARIES'),
                    'ffprobe.binaries' => env('FFPROBE_BINARIES'),
                    'timeout' => 3600,
                    'ffmpeg.threads' => 12,
                ]);

                $video = $ffmpeg->open($fullVideoPath);
                $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(1))
                    ->save($fullThumbnailPath);
            } catch (\Exception $e) {
                \Log::error("FFMpeg Error: " . $e->getMessage());
            }
        }

        $video = new Video();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->file_path = $videoPath;
        $video->thumbnail_path = $thumbnailName;

        if (auth()->check()) {
            $video->user_id = auth()->id();
        } else {
            return redirect('/login');
        }

        $video->save();

        return redirect('/videos');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);

        return view('videos.show', [
            'video' => $video
        ]);
    }
}
