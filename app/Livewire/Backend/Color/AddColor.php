<?php

namespace App\Livewire\Backend\Color;

use Livewire\Component;
use App\Models\Color;
class AddColor extends Component
{
    public $recordId = null, $title,$color_code;
    public function render()
    {
        return view('livewire.backend.color.add-color');
    }
    public function mount($recordId=null){
        $this->recordId=$recordId;
        $this->products=$this->recordId ? Color::find($this->recordId) : new Color();
        if ($this->products) {
            $this->title=$this->products->title;
            $this->color_code=$this->products->color_code;
           
        }
    }
    public function store()
    {   
        $product = $this->recordId ? Color::find($this->recordId) : new Color(); // Use Product model
        $product->title = $this->title;
        $product->color_code = $this->color_code;
        $product->save();
        session()->flash('message', 'Post successfully updated.');
        return redirect()->route('list-color');
    }
}
