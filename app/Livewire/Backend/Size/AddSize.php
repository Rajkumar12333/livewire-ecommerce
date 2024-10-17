<?php

namespace App\Livewire\Backend\Size;

use Livewire\Component;
use App\Models\Size;
class AddSize extends Component
{
    public $recordId = null, $title;
    public function render()
    {
        return view('livewire.backend.size.add-size');
    }
    public function mount($recordId=null){
        $this->recordId=$recordId;
        $this->products=$this->recordId ? Size::find($this->recordId) : new Size();
        if ($this->products) {
            $this->title=$this->products->title;
           
        }
    }
    public function store()
    {   
        $product = $this->recordId ? Size::find($this->recordId) : new Size(); // Use Product model
        $product->title = $this->title;
        $product->save();
        session()->flash('message', 'Post successfully updated.');
        return redirect()->route('list-size');
    }
}
