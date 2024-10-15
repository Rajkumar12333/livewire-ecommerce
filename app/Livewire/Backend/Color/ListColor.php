<?php

namespace App\Livewire\Backend\Color;

use Livewire\Component;
use App\Models\Color;
class ListColor extends Component
{
    public function render()
    {
        $products=Color::orderBy('id','desc')->get();
        return view('livewire.backend.color.list-color',[
            'products'=>$products
        ]);
    }
}
