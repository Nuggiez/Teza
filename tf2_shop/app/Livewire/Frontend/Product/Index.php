<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    public $product_id;

    public function render()
    {
        $products = Product::where('user_id', Auth::id())
            ->with('category')
            ->orderBy('id', 'ASC')
            ->paginate(5);
        return view('livewire.frontend.product.index', ['products' => $products]);
    }

    public function confirmDelete($product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {
        $product = Product::where('id', $this->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($product) {
            $path = 'uploads/product/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $product->delete();
            session()->flash('message', 'Product Deleted Successfully');
        } else {
            session()->flash('error', 'You are not authorized to delete this product.');
        }
    }
}
