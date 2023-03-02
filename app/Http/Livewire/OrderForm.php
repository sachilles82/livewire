<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class OrderForm extends Component
{
    public Order $order;

    public Collection $allProducts;

    public bool $editing = false;

    public array $orderProducts = [];

    public array $listsForFields = [];

    public int $taxesPercent = 0;

    public function mount(Order $order): void
    {
        $this->order = $order;

        if ($this->order->exists) {
            $this->editing = true;
        } else {
            $this->order->order_date = today();
        }

        $this->initListsForFields();

        $this->taxesPercent = config('app.orders.taxes');
    }

    public function render(): View
    {
        return view('livewire.order-form');
    }

    public function rules(): array
    {
        return [
            'order.user_id' => ['required', 'integer', 'exists:users,id'],
            'order.order_date' => ['required', 'date'],
            'order.subtotal' => ['required', 'numeric'],
            'order.taxes' => ['required', 'numeric'],
            'order.total' => ['required', 'numeric'],
            'orderProducts' => ['array']
        ];
    }

    public function addProduct(): void
    {
        foreach ($this->orderProducts as $key => $product) {
            if (!$product['is_saved']) {
                $this->addError('orderProducts.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }

        $this->orderProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_price' => 0
        ];
    }

    public function saveProduct($index): void
    {
        $this->resetErrorBag();
        $product = $this->allProducts->find($this->orderProducts[$index]['product_id']);
        $this->orderProducts[$index]['product_name'] = $product->name;
        $this->orderProducts[$index]['product_price'] = $product->price;
        $this->orderProducts[$index]['is_saved'] = true;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['users'] = User::pluck('name', 'id')->toArray();

        $this->allProducts = Product::all();
    }
}
