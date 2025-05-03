<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }
    

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();
        $category = new Category;
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower($validatedData['name']).'.'.$ext;

            $file->move('uploads/category',$filename);
            $category->image = $filename;
        }

        $category->save();
        return redirect('admin/category')->with('message','Category Added Successfully');

    }

    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {
        $category = Category::findOrFail($category);
        $validatedData = $request->validated();
       
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        if($request->hasFile('image')){
            $path = 'uploads/category/' . $category->image;
            if(File::exists($path)){
               File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower($validatedData['name']).'.'.$ext;

            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->update();

        return redirect('admin/category')->with('message','Category Updated Successfully');
    }
}

