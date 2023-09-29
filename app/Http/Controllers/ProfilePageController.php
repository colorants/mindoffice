<?php

namespace App\Http\Controllers;

use App\Models\User;


class ProfilePageController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
