<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\Product;
class ListProduct extends Component
{
    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];
    public function render()
    {
        // $products=Product::orderBy('id','desc')->get();
        return view('livewire.backend.product.list-product',[
            // 'products'=>$products
        ]);
    }

 
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete($id)
    {
        Product::find($id)->delete();
        $this->dispatch('error', 'Product Deleted');
        return redirect()->route('list-products');
    }
}
