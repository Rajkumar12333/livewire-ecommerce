<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\Product;

class ListProduct extends Component
{
    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];

    public $isOpen = false,$product=[];
    public function openPopup($productId)
    {
        $this->product = Product::find($productId); // Make sure product details are fetched
   
        $this->isOpen = true; // Open the popup
    }

    // Event handler to close the popup
    public function closePopup()
    {
        $this->isOpen = false; // Close the popup
    }
    public function render()
    {
        return view('livewire.backend.product.list-product');
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Product Deleted');
        return redirect()->route('list-products');
    }
}
