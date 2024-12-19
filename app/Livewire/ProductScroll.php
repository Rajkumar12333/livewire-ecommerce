<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
class ProductScroll extends Component
{
    public $products=[];
    public function mount(){
        $this->products=Product::get();
    }
    public function render()
    {
        return view('livewire.product-scroll');
    }
}
