<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $categories;
    public $searchQuery;
    public $searchCategory;


    public function mount()
    {
        $this->categories = Category::all();
        $this->searchQuery = '';
        $this->searchCategory = '';
    }

    public function render()
    {
        $products = Product::with('category')
            ->when($this->searchQuery != '', function ($query){
                $query->where('name' , 'like', '%'.$this->searchQuery.'%');
            })
            ->when($this->searchCategory != '', function ($query){
                $query->where('category_id' , $this->searchCategory);
            })
            ->paginate(10);
        return view('livewire.products', [
            'products' => $products
        ]);

    }
}
