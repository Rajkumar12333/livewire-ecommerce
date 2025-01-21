<?php

namespace App\Livewire\Table;

use Livewire\Component;
use Yajra\DataTables\DataTables;
use App\Models\User;

class UserDatatables extends Component
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
        return view('livewire.table.user-datatables',[
              'page_title'=>'List Users | Ecommerce'
        ])->layout('layouts.app');
    }

 
}
