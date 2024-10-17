<?php

namespace App\Livewire\Backend\Size;

use Livewire\Component;
use App\Models\Size;
class ListSize extends Component
{
    public function render()
    {
        $products=Size::orderBy('id','desc')->get();
        return view('livewire.backend.size.list-size',[
            'products'=>$products
        ]);
    }
}
