<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Product,Wishlist};
class UserWishlist extends Component
{
    public  $wishlistProducts=[];
    public function mount(){
        $this->wishlistProducts = Product::whereIn('id', Wishlist::where('user_id', auth()->id())->pluck('product_id'))->get();
    }
    public function render()
    {
        return view('livewire.user-wishlist')->layout('layouts.user-dashboard');
    }
}
