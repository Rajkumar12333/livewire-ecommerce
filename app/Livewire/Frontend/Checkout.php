<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class Checkout extends Component
{
    public $cart=[];
    public function render()
    {
        return view('livewire.frontend.checkout', [
            'subtotal' => $this->calculateSubtotal(),
            'total' => $this->calculateTotal(),
        ]);
    }
    public function placeholder()
    {
        return <<<'HTML'
            <div>
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>
            </div>
        HTML;
    }
    public function mount(){
        $this->loadCart();
    } 
    public function loadCart()
    {
        $this->cart = Cart::where('user_id', Auth::id())
        ->with(['product' => function($query) {
            $query->select('id', 'title', 'price','image'); // Make sure to include 'id'
        }])
        ->get();
    }
    public function calculateSubtotal()
    {
        $subtotal = 0;

        // Loop through the cart items to calculate the subtotal
        foreach ($this->cart as $item) {
            $subtotal += $item['product']['price'] * $item['quantity'];
        }

        return $subtotal;
    }

    public function calculateTotal()
    {
        // In this simple example, the total is equal to the subtotal
        // You can add any additional charges like tax or shipping if needed
        return $this->calculateSubtotal();
    }
}
