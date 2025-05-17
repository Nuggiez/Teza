<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    public $product_id;

    public function render()
    {
        $products = Product::orderBy('id', 'ASC')->paginate(5);
        return view('livewire.frontend.product.index', ['products' => $products]);
    }

    public function confirmDelete($product_id)
    {
        $this->product_id = $product_id;
    }

    public function destroyProduct()
    {
        $product = Product::find($this->product_id);
        
        $path = 'uploads/product/'.$product->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $product->delete();
        session()->flash('message','product Deleted Successfully');
    }
}
