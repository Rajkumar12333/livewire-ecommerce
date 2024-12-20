<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Product,Cart};
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class FeaturedProducts extends Component
{
    public $filter = '*'; // Tracks the current filter
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function setFilter($filter)
    {
        $this->filter = $filter === '*' ? '*' : (int) $filter; // Ensure valid filter values
        
    }
    public function mount(){
        $this->filter="*";
        $this->setFilter($this->filter);
    }

    public function render()
    {
        $feature_products = $this->filter === '*'
            ? Product::all()
            : Product::where('department_id', $this->filter)->get();

        $departmnet = Department::all(); // Use all() for consistency

        return view('livewire.frontend.featured-products', compact('feature_products', 'departmnet'));
    }
    public function addToCart($productId)
    {
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
