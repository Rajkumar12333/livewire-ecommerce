<?php

namespace App\Livewire\Backend\Color;

use Livewire\Component;
use App\Models\Color;
class AddColor extends Component
{
    public $recordId = null, $title;
    public function render()
    {
        return view('livewire.backend.color.add-color');
    }
    public function mount($recordId=null){
        $this->recordId=$recordId;
        $this->products=$this->recordId ? Color::find($this->recordId) : new Color();
        if ($this->products) {
            $this->title=$this->products->title;
           
        }
    }
    public function store()
    {   
        $product = $this->recordId ? Color::find($this->recordId) : new Color(); // Use Product model
        $product->title = $this->title;
        $product->save();
        session()->flash('message', 'Post successfully updated.');
        return redirect()->route('list-color');
    }
}
