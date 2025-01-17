<?php

namespace App\Livewire\Backend\User;

use Livewire\Component;
use App\Models\cart;

class CartList extends Component
{
    public function render()
    {
       
        return view('livewire.backend.user.cart-list',[
           
        ])->layout('layouts.user-dashboard');
    }
}
