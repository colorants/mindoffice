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
                return view ('videos.by-category',compact('category'));
            }

            public function create()
        {
            return view ('videos.category.create');
        }}

