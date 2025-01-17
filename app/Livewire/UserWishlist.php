<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{Product,Wishlist};
class UserWishlist extends Component
{
    // public  $wishlistProducts=[];
    public function mount(){
    
    }
    public function render()
    {
        $wishlistProducts = Product::whereIn('id', Wishlist::where('user_id', auth()->id())->pluck('product_id'))->paginate(1);
        return view('livewire.user-wishlist',[
            'wishlistProducts'=>$wishlistProducts
        ])->layout('layouts.user-dashboard');
    }
}
