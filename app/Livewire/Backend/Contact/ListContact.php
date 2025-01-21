<?php

namespace App\Livewire\Backend\Contact;

use Livewire\Component;
use App\Models\Contact;
class ListContact extends Component
{
    public $isOpen = false,$contact=[];
    public function openPopup($id)
    {
        $this->contact = Contact::find($id); // Make sure product details are fetched
   
        $this->isOpen = true; // Open the popup
    }

    // Event handler to close the popup
    public function closePopup()
    {
        $this->isOpen = false; // Close the popup
    }
    public function render()
    {
        $products=Contact::orderBy('id','desc')->get();
        return view('livewire.backend.contact.list-contact',[
            'products'=>$products
        ]);
    }
}
