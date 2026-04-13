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
            'file_path' => 'required',
        ]);

        $video = new Video();

        $video->title = $request->title;
        $video->description = $request->description;
        $video->file_path = $request->file_path;

        $video->save();

        return redirect('/videos');
    }
}
