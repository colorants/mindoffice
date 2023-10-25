<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilePageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function display_all()

    {
        $users = User::all();
        return view('users.display_all', [
            'users' => $users,
        ]);
    }

    // Show the profile of the currently authenticated user
    public function index()
    {
        $user = Auth::user();
        return view('users.index', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        // Check if the authenticated user matches the user being edited
        if (auth()->user()->id !== $user->id) {
            return redirect()->route('users.index')->with('error', 'You are not authorized to edit this profile.');
        }

        // Load the user's profile for editing
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Check if the authenticated user matches the user being updated
        if (auth()->user()->id !== $user->id) {
            return redirect()->route('users.index')->with('error', 'You are not authorized to update this profile.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional: Validate image upload
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/profiles', 'public');
        } else {
            $imagePath = null; // or set a default image path if no image is uploaded
        }

        // Update user profile fields
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'image' => $imagePath, // Store the image path
            // Add other profile fields as needed
        ]);

        return redirect()->route('users.index')->with('success', 'Profile updated successfully.');
    }

    public function favorites (User $user)
    {
        $videos = $user->favoritedVideos();
        return view('users.index', [
            'videos' => $videos,
        ]);
    }
}

