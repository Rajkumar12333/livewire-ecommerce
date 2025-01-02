<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
class ShopSearch extends Component
{

    public $query = '';
    public $products = [];

    public function updatedQuery()
    {
        $this->products = Product::where('title', 'like', '%' . $this->query . '%')
            ->get();

            logger($this->products);
    }


    public function render()
    {
        return view('livewire.frontend.shop-search');
    }
}
