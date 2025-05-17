<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('frontend.category.index');
    }
}
