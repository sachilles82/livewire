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

    public array $listsForFields = [];

    public int $taxesPercent = 0;

    public function mount(Order $order): void
    {
        $this->order = $order;

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

    protected function initListsForFields(): void
    {
        $this->listsForFields['users'] = User::pluck('name', 'id')->toArray();

        $this->allProducts = Product::all();
    }
}
