<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index',]);
    }

    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');
        $query = $request->input('query', '');

        if (Auth::check()) {
            $user = Auth::user();
            $videos = $user->is_admin ? Video::orderBy($sortBy)->where('title', 'like', '%' . $query . '%')->get() :
                Video::orderBy($sortBy)->where('active', true)->where('title', 'like', '%' . $query . '%')->get();
        } else {
            $videos = Video::orderBy($sortBy)->where('active', true)->where('title', 'like', '%' . $query . '%')->get();
        }

        $categories = Category::all();

        return view('videos.index', [
            'videos' => $videos,
            'categories' => $categories,
            'query' => $query,
            'sort_by' => $sortBy,
        ]);
    }


    public function create()
    {
        $user = Auth::user();
        $favoriteVideoCount = $user->favoriteVideos()->count();

        if ($favoriteVideoCount >= 3) {
            return view('videos.create', [
                'video' => new Video(),
                'categories' => Category::all(),
            ]);
        } else {
            return redirect()->route('videos.index')->with('error', 'You need to favorite at least 3 videos before uploading.')->with('showPopup', true);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $favoriteVideoCount = $user->favoriteVideos()->count();

        if ($favoriteVideoCount >= 3) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('uploads/videos', 'public');
            } else {
                $imagePath = null;
            }

            $video = new Video();
            $video->user_id = Auth::user()->id;
            $video->title = $request->input('title');
            $video->description = $request->input('description');
            $video->category_id = $request->input('category_id');
            $video->image = $imagePath;

            $video->save();

            return redirect()->route('videos.index')->with('success', 'Video uploaded successfully!');
        } else {
            return redirect()->route('videos.index')->with('error', 'You need to favorite at least 3 videos before uploading.');
        }
    }

    public function show(Video $video)
    {
        return view('videos.show', [
            'video' => $video,
            'category' => Category::all(),
        ]);
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('videos.edit', [
            'video' => $video,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Video $video)
    {
        if ($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('uploads/videos', 'public');
            $video->image = $newImagePath;
        }

        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->category_id = $request->input('category_id');
        $video->active = $request->has('active');
        $video->save();

        return redirect()->route('videos.index');
    }

    public function toggleActive(Request $request, Video $video)
    {
        $video->active = $request->has('active');
        $video->save();

        return redirect()->route('videos.index');
    }

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
            $user->favoriteVideos()->detach($video->id);
            $message = 'Video removed from favorites.';
        } else {
            $user->favoriteVideos()->attach($video->id);
            $message = 'Video added to favorites.';
        }

        return redirect()->route('videos.index', $video)->with('success', $message);
    }
}


