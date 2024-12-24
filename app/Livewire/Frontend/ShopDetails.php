<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Product, Wishlist, Cart};
use Illuminate\Support\Facades\Auth;

class ShopDetails extends Component
{
    public $recordId;
    public $products = [], $carts = [], $wishlistItems = [];
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('livewire.frontend.shop-details');
    }

    public function mount($recordId = null)
    {
        $this->recordId = $recordId;

        // Fetch the product based on unique_id
        $this->products = Product::where('unique_id', $this->recordId)->first();

        // If the product is found, check cart and wishlist
        if ($this->products) {
            $this->carts = Cart::where('product_id', $this->products->id)
                               ->where('user_id', Auth::id())
                               ->first();
        } else {
            $this->products = null;  // Explicitly set to null if product is not found
        }

        // Fetch wishlist items for the current user
        $this->wishlistItems = Wishlist::where('user_id', auth()->id())
                                       ->pluck('product_id')
                                       ->toArray();
    }

    public function increaseQuantity($cartItemId)
    {
        if ($cartItemId=="0") {
            $this->dispatch('error', 'Product not available in the cart');
            return;
        }
        $cartItem = Cart::find($cartItemId);

        if (!$cartItem || $cartItem->user_id !== Auth::id()) {
            $this->dispatch('error', 'Cart item not found or access denied.');
            return;
        }

        $cartItem->quantity++;
        $cartItem->save();

        $this->dispatch('success', 'Product quantity increased.');
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

        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
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

        $this->dispatch('success', 'Product added to Wishlist');
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }

    public function removeFromWishlist($productId)
    {
        Wishlist::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();

        $this->dispatch('error', 'Product removed from Wishlist');
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

      
    }
}
