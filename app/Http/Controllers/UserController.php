<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'display_all']);
    }

    public function display_all()

    {
        $companies = Company::all();
        $users = User::all();
        return view('users.display_all', [
            'users' => $users,
            'companies' => $companies,
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

public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('users.display_all')->with('success', 'User deleted successfully.');
}

    public function edit(User $user)
    {
        if (auth()->user()->is_admin || auth()->user()->id === $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->route('users.index')->with('error', 'You are not authorized to edit this profile.');
        }
    }

    public function makeAdmin(Request $request, User $user)
    {
        if (auth()->user()->id === $user->id) {
            // User is updating their own profile, redirect to users.index
            return redirect()->route('users.index')->with('success', 'You are now an admin.');
        }

        $user->is_admin = true;
        $user->save();

        return redirect()->route('users.display_all')->with('success', 'User is now an admin.');
    }

    public function removeAdmin(Request $request, User $user)
    {

        if (auth()->user()->id === $user->id) {
            return redirect()->route('users.index')->with('success', 'Admin status removed.');
        }

        $user->is_admin = false;
        $user->save();

        return redirect()->route('users.display_all')->with('success', 'Admin status removed.');
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
        ]);

        return redirect()->route('users.index')->with('success', 'Profile updated successfully.');
    }

}

