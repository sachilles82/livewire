<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
        $this->order->subtotal = 0;

        foreach ($this->orderProducts as $orderProduct) {
            if ($orderProduct['is_saved'] && $orderProduct['product_price'] && $orderProduct['quantity']) {
                $this->order->subtotal += $orderProduct['product_price'] * $orderProduct['quantity'];
            }
        }

        $this->order->total = $this->order->subtotal * (1 + $this->taxesPercent / 100);
        $this->order->taxes = $this->order->total - $this->order->subtotal;

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

    public function editProduct($index): void
    {
        foreach ($this->orderProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('$this->orderProducts.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->orderProducts[$index]['is_saved'] = false;
    }

    public function removeProduct($index): void
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }

    public function saveProduct($index): void
    {
        $this->resetErrorBag();
        $product = $this->allProducts->find($this->orderProducts[$index]['product_id']);
        $this->orderProducts[$index]['product_name'] = $product->name;
        $this->orderProducts[$index]['product_price'] = $product->price;
        $this->orderProducts[$index]['is_saved'] = true;
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $this->order->order_date = Carbon::parse($this->order->order_date)->format('d-m-Y');

        $this->order->save();

        $products = [];

        foreach ($this->orderProducts as $product) {
            $products[$product['product_id']] = ['price' => $product['product_price'], 'quantity' => $product['quantity']];
        }

        $this->order->products()->sync($products);

        return redirect()->route('orders.index');
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['users'] = User::pluck('name', 'id')->toArray();

        $this->allProducts = Product::all();
    }
}
