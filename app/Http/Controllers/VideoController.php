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
        $sortOrder = $request->input('sort_order', 'desc');
        $query = $request->input('query', '');

        if (Auth::check()) {
            $user = Auth::user();
            $videosQuery = $user->is_admin ? Video::query() : Video::where('active', true);
        } else {
            $videosQuery = Video::where('active', true);
        }

        $videos = $videosQuery->where('title', 'like', '%' . $query . '%')
            ->orderBy($sortBy, $sortOrder)
            ->get();

        $categories = Category::all();

        return view('videos.index', [
            'videos' => $videos,
            'categories' => $categories,
            'query' => $query,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);
    }



    public function create()
    {
        $user = Auth::user();
        $favoriteVideoCount = $user->favoriteVideos()->count();

        if ($favoriteVideoCount >= 3 || $user->is_admin) {
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

        if ($favoriteVideoCount >= 3 || $user->is_admin) {
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
        // Check if the authenticated user is the owner of the video
        if (Auth::user()->id !== $video->user_id) {
            return redirect()->route('videos.index')->with('error', 'You do not have permission to edit this video.');
        }

        $categories = Category::all();
        return view('videos.edit', [
            'video' => $video,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Video $video)
    {
        // Check if the authenticated user is the owner of the video
        if (Auth::user()->id !== $video->user_id) {
            return redirect()->route('videos.index')->with('error', 'You do not have permission to update this video.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if a new image file is uploaded
        if ($request->hasFile('image')) {
            // Delete the existing image if there is one
            if ($video->image) {
                Storage::disk('public')->delete($video->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('uploads/videos', 'public');
            $video->image = $imagePath;
        }

        // Update other fields
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        $video->category_id = $request->input('category_id');
        $video->active = $request->has('active');
        $video->save();

        // Redirect to videos.index after successful update
        return redirect()->route('videos.index')->with('success', 'Video updated successfully!');
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


