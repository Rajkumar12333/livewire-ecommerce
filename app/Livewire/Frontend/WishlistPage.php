<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Product,Wishlist};
class WishlistPage extends Component
{
    public $wishlistProducts=[],$wishlistItems=[];
    public function mount(){
        $this->wishlistProducts = Product::whereIn('id', Wishlist::where('user_id', auth()->id())->pluck('product_id'))->get();
        $this->wishlistItems = \App\Models\Wishlist::where('user_id', auth()->id())
        ->pluck('product_id')
        ->toArray();
    }
    public function render()
    {
        return view('livewire.frontend.wishlist-page');
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
    }

    public function removeFromWishlist($productId)
    {
        Wishlist::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();

        $this->dispatch('error', 'Product removed from Wishlist');
        $this->dispatch('refreshComponent');
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

        // Refresh wishlist items after toggling
        $this->wishlistItems = Wishlist::where('user_id', auth()->id())
                                       ->pluck('product_id')
                                       ->toArray();
        $this->wishlistProducts = Product::whereIn('id', Wishlist::where('user_id', auth()->id())->pluck('product_id'))->get();
    }
}
