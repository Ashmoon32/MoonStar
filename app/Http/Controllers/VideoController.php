<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Symfony\Component\Translation\Catalogue\AbstractOperation;
use Illuminate\Support\Facades\Storage;

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

            if (!Storage::disk('public')->exists('thumbnails')) {
                Storage::disk('public')->makeDirectory('thumbnails');
            }

            $fullVideoPath = storage_path('app/public/' . $videoPath);
            $thumbnailName = 'thumbnails/' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';
            $fullThumbnailPath = storage_path('app/public/' . $thumbnailName);

            try {
                $ffmpeg = \FFMpeg\FFMpeg::create([
                    'ffmpeg.binaries' => env('FFMPEG_BINARIES'),
                    'ffprobe.binaries' => env('FFPROBE_BINARIES'),
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

    public function edit($id)
    {
        $video = Video::findOrFail($id);

        if ($video->user_id !== auth()->id()) {
            abort(403);
        }

        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        if ($video->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
        ]);

        $video->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/videos')->with('status', 'Video updated!');
    }

    public function destroy($id)
    {
        $video = Video::FindorFail($id);

        if ($video->user_id !== auth()->id()) {
            abort(403);
        }

        $filesToDelete = array_filter([
            $video->file_path,
            $video->thumbnail_path,
        ]);

        if (!empty($filesToDelete)) {
            \Storage::disk('public')->delete($filesToDelete);
        }

        $video->delete();

        return redirect('/videos')->with('status', 'Video deleted forever!');
    }
}
