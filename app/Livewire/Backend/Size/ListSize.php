<?php

namespace App\Livewire\Backend\Size;

use Livewire\Component;
use App\Models\Size;
class ListSize extends Component
{
    public $isOpen = false,$sizeFetch=[];
    public function openPopup($id)
    {
        $this->sizeFetch = Size::find($id); // Make sure product details are fetched
   
        $this->isOpen = true; // Open the popup
    }

    // Event handler to close the popup
    public function closePopup()
    {
        $this->isOpen = false; // Close the popup
    }
    public function render()
    {
        $products=Size::orderBy('id','desc')->get();
        return view('livewire.backend.size.list-size',[
            'products'=>$products
        ]);
    }
}
