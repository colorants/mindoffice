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

    public function index()
    {
        $videos = Video::all();
        return view ('videos.index',compact('videos'));
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
//            'filename'=>'required',
//            'category_id'=>'required|numeric',
        ]);

        $video = new Video();
        $video->user_id = $user_id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
//        $video->filename = $request->input('filename');
//        $video->category_id = $request->input('category_id');

        $video->save(); //insert into
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
