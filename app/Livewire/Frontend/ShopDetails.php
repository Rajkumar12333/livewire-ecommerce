<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;
class ShopDetails extends Component
{
    public $recordId;
    public $products=[],$carts=[];
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.frontend.shop-details');
    }
    public function mount($recordId=null){
       
        $this->recordId=$recordId;
        
        $this->products=Product::where('unique_id',$this->recordId)->first();
        $this->carts=Cart::where('product_id',$this->products->id)->where('user_id',Auth::id())->first();
        
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
       
        $this->dispatch('refreshComponent');
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
    
       
        $this->dispatch('refreshComponent');
    }
    public function addToCart($productId)
    {
        if (!Auth::check()) {
            $this->dispatch('error', 'Please log in to purchase this product.');
            return;
        }
       
        $product = Product::find($productId);
   
        if (!$product) {
            $this->dispatch('error', 'Product not found.');
            return;
        }

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();
        
        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // If it's a new product, add it to the cart
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $this->dispatch('success', 'Product added to cart');
       
        $this->dispatch('refreshComponent');
       
    }
}
