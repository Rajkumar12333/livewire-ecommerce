<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
class ShopDetails extends Component
{
    public $recordId;
    public $products=[];
    public function render()
    {
        return view('livewire.frontend.shop-details');
    }
    public function mount($recordId=null){
        $this->products=Product::where('unique_id',$this->recordId)->first();
       
    }
}
