<?php

namespace App\Livewire\Frontend\Category;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    public $product_id;
    public $category;

    public function mount($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $products = Product::where('category_id', $this->category->id)
            ->orderBy('id', 'ASC')
            ->paginate(12);
        return view('livewire.frontend.category.index', compact('products'));
    }
}
