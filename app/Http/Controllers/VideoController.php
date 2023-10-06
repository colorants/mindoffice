<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//    public function __construct()
//    {
//        $this->middleware('auth')->except(['index','show']);
//    }

public function __construct()
{
    $this->middleware('auth')->except(['index', 'show']);
}

    public function index()
    {
       return view ('videos.index', [
           'videos' => Video::all(),
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'category_id'=>'required|numeric',
        ]);

        $video = new Video();
        $video->user_id = $user_id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        $video->save(); //insert into

        return redirect()->route('videos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('videos.show', [
            'videos' => $video,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        return view('videos.edit', [
            'videos' => $video,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
       $video->delete();
         return redirect()->route('videos.index');
    }
}
