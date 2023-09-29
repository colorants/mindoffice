<?php

namespace App\Http\Controllers;

use App\Models\Category;

class VideoCategoryController extends Controller
{
    public function index()
    {

    }

    public function byCategory(int $categoryId)
    {
        $category = Category::find($categoryId);
        return view ('video.by-category',compact('category'));
    }
}
