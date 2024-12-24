<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
class ShopingCart extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $cart=[];
    public function render()
    {
        return view('livewire.frontend.shoping-cart', [
            'subtotal' => $this->calculateSubtotal(),
            'total' => $this->calculateTotal(),
        ]);
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
    public function removeProduct($id)
    {
        // Find the product in the cart for the authenticated user
        $product = Cart::where('user_id', auth()->user()->id)
                       ->where('product_id', $id)
                       ->first();

        if ($product) {
            // Delete the product from the cart
            $product->delete();

            // Emit a success message to the frontend
            $this->dispatch('error', 'Product removed from cart successfully!');
            $this->dispatch('refreshComponent');
            return redirect()->to('/shoping-cart');
        } else {
            // Emit an error message to the frontend if product is not found
            $this->dispatch('error', 'Product not found in your cart!');
        }
        $this->dispatch('reloadPage');
        
    }

    public function increaseQuantity($cartItemId)
    {
        $cartItem = Cart::find($cartItemId);
    
        if (!$cartItem || $cartItem->user_id !== Auth::id()) {
            $this->dispatch('error', 'Cart item not found or access denied.');
            return;
        }
    
        $cartItem->quantity++;
        $cartItem->save();
    
        $this->dispatch('success', 'Product quantity increased.');
        $this->loadCart();
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }
    public function decreaseQuantity($cartItemId)
    {
        $cartItem = Cart::find($cartItemId);
    
        if (!$cartItem || $cartItem->user_id !== Auth::id()) {
            $this->dispatch('error', 'Cart item not found or access denied.');
            return;
        }
    
        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
    
            $this->dispatch('success', 'Product quantity decreased.');
        } else {
            $cartItem->delete();
            $this->dispatch('success', 'Product removed from cart.');
        }
    
        $this->loadCart();
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }
        
}
