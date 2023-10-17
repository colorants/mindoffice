<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Client\Request;


class ProfilePageController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', true)->get();
        return view('users.index', compact('users'));
    }


    public function update(Request $request, User $user)
    {
        $user->update([
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()->route('users.index')->with('success', 'Admin status updated successfully.');
    }

}
