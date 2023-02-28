<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductsCreate extends Component
{
    public $categories;
    public Product $product;

    protected $rules = [
        'product.name' => 'required|min:5',
        'product.description' => 'required | max:500',
        'product.category_id' => 'required | integer'

    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->product = new Product();
    }

    public function render()
    {
        return view('livewire.products-create');
    }

    public function save()
    {
        $this->validate();

        $this->product->save();

        return redirect()->route('products');
    }

    public function updatedProductName()
    {
        $this->validateOnly('product.name');
    }
}
