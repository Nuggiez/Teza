<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        return view('frontend.product.index');
    }

    public function index2(Request $request)
    {
        $id = $request->query('id');
        if ($id) {
            return redirect()->route('product.single', ['id' => $id]);
        }
        return abort(404); // or show a default page
    }

    public function create()
    {
        $categories = Category::all();
        return view('frontend.product.create', compact('categories'));
    }

    public function store(ProductFormRequest $request)
    {
        $validatedData = $request->validated();

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        $product->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = strtolower($validatedData['name']) . '.' . $file->getClientOriginalExtension();
        
            // Save directly into public/uploads/product
            $file->move(public_path('uploads/product'), $filename);
        
            $product->image = $filename;
        }

        $product->save();

        return redirect('frontend/product')->with('message', 'Product Added Successfully');
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to edit this product.');
        }

        $categories = Category::all();
        return view('frontend.product.edit', compact('categories', 'product'));
    }

    public function update(ProductFormRequest $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this product.');
        }
        
        $validatedData = $request->validated();

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];

        if ($request->hasFile('image')) {
            $path = 'uploads/product/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower($validatedData['name']) . '.' . $ext;

            $file->move('uploads/product/', $filename);
            $product->image = $filename;
        }
        $product->update();

        return redirect('frontend/product')->with('message', 'Product Updated Successfully');
    }

    public function showSingle($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.product.single', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%{$query}%")->paginate(12);

        return view('frontend.product.search', compact('products', 'query'));
    }
}
