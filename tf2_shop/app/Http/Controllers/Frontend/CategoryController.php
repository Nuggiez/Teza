<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
        return view('frontend.category.index', compact('category'));
    }
}
