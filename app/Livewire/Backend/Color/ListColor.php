<?php

namespace App\Livewire\Backend\Color;

use Livewire\Component;
use App\Models\Color;
class ListColor extends Component
{
    public $isOpen = false,$product=[];
    public function openPopup($productId)
    {
        $this->product = Color::find($productId); // Make sure product details are fetched
   
        $this->isOpen = true; // Open the popup
    }

    // Event handler to close the popup
    public function closePopup()
    {
        $this->isOpen = false; // Close the popup
    }
    public function render()
    {
        $products=Color::orderBy('id','desc')->get();
        return view('livewire.backend.color.list-color',[
            'products'=>$products
        ]);
    }
    public function delete($id)
    {
        Color::find($id)->delete();
        $this->dispatch('error', 'Color Removed');
        return redirect()->route('list-color');
    }
}
