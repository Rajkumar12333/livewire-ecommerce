<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Product;
class RelatedProduct extends Component
{
    public $recordId;
    public $relatedProducts=[];
    public $products=[];
    public function render()
    {
        return view('livewire.frontend.related-product');
    }
    public function mount($recordId=null){
        $this->products=Product::where('unique_id',$this->recordId)->first();
        $this->relatedProducts = Product::where('department_id', $this->products->category_id)
                            ->where('id', '!=', $this->products->id) // Exclude the current product
                            ->limit(4)
                            ->get();
                           
    }
}
