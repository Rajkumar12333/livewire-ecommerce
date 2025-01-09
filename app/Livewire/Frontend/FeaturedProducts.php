<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Product,Cart,Wishlist};
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class FeaturedProducts extends Component
{
    public $filter = '*',$wishlistItems=[]; // Tracks the current filter
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function setFilter($filter)
    {
        $this->filter = $filter === '*' ? '*' : (int) $filter; // Ensure valid filter values
        
    }
    public function mount(){
        $this->filter="*";
        $this->setFilter($this->filter);
        $this->wishlistItems = \App\Models\Wishlist::where('user_id', auth()->id())
        ->pluck('product_id')
        ->toArray();
    }

    public function render()
    {
        $feature_products = $this->filter === '*'
            ? Product::orderBy('id', 'desc')->get()
            : Product::orderBy('id', 'desc')->where('department_id', $this->filter)->get();

        $departmnet = Department::all(); // Use all() for consistency

        return view('livewire.frontend.featured-products', compact('feature_products', 'departmnet'));
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
        $this->dispatch('reloadPage');
    }
    public function addToWishlist($productId)
    {
        if (!Auth::check()) {
            $this->dispatch('error', 'Please log in to purchase this product.');
            return;
        }
       
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ]);

        $this->products = auth()->user()->wishlistProducts;
        $this->dispatch('success', 'Product added to Whishlist');
      
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }
    public function removeFromWishlist($productId)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();

        $this->products = auth()->user()->wishlistProducts;
        $this->dispatch('error', 'Product Removed to Whishlist');
      
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }
    public function toggleWishlist($productId)
    {
        if (in_array($productId, $this->wishlistItems)) {
            // If the product is already in the wishlist, remove it
            $this->removeFromWishlist($productId);
        } else {
            // If the product is not in the wishlist, add it
            $this->addToWishlist($productId);
        }
          $this->wishlistItems = \App\Models\Wishlist::where('user_id', auth()->id())
        ->pluck('product_id')
        ->toArray();
    }
    
}
