<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function __construct()
{
    $this->middleware('auth')->except(['index', 'show']);
}

    public function index()
    {
        // Check if there is an authenticated user
        if (Auth::check()) {
            // If the user is an admin, fetch all videos (both active and inactive)
            // If the user is not an admin, fetch only active videos
            $user = Auth::user();
            $videos = $user->is_admin ? Video::all() : Video::where('active', true)->get();
        } else {
            // If there is no authenticated user, fetch only active videos
            $videos = Video::where('active', true)->get();
        }

        $categories = Category::all();

        return view('videos.index', [
            'videos' => $videos,
            'categories' => $categories,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('videos.create' , [
            'video' => new Video(), // Create a new instance of the Video model to be used in the form
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: Validate image upload
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/videos', 'public');
        } else {
            $imagePath = null; // or set a default image path if no image is uploaded
        }

        $video = new Video();
        $video->user_id = Auth::user()->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->category_id = $request->input('category_id');
        $video->image = $imagePath; // Store the image path

        $video->save();

        return redirect()->route('videos.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        return view('videos.show', [
            'video' => $video,
            'category' => Category::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('videos.edit', [
            'video' => $video,
            'categories' => $categories,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        // Validate request and update other fields (title, description, category_id)

        // Handle image update if a new image is provided
        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('uploads/videos', 'public');
            $video->image = $newImagePath;
        }

        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->category_id = $request->input('category_id');
        $video->active = $request->has('active'); // Set active status based on checkbox value
        $video->save();

        return redirect()->route('videos.index');
    }

    public function toggleActive(Request $request, Video $video)
    {
        $video->active = $request->has('active');
        $video->save();

        return redirect()->route('videos.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
       $video->delete();
         return redirect()->route('videos.index');
    }

    public function active(Video $video)
    {
        $request = new Request();
        $video->active = $request->has('active');
        $video->save();

        return redirect()->route('videos.index');
    }

    public function toggleFavorite(Request $request, Video $video)
    {
        $user = auth()->user();

        if ($user->favoriteVideos()->where('video_id', $video->id)->exists()) {
            $user->favoriteVideos()->detach($video->id); // Remove from favorites
            $message = 'Video removed from favorites.';
        } else {
            $user->favoriteVideos()->attach($video->id); // Add to favorites
            $message = 'Video added to favorites.';
        }

        return response()->json(['message' => $message]);
    }


}
