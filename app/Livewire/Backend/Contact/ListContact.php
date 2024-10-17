<?php

namespace App\Livewire\Backend\Contact;

use Livewire\Component;
use App\Models\Contact;
class ListContact extends Component
{
    public function render()
    {
        $products=Contact::orderBy('id','desc')->get();
        return view('livewire.backend.contact.list-contact',[
            'products'=>$products
        ]);
    }
}
