<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{
    use WithPagination;
    public $category_id;

    public function render()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate(5);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }

    public function confirmDelete($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        
        $path = 'uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }

        $category->delete();
        session()->flash('message','Category Deleted Successfully');
    }
}
