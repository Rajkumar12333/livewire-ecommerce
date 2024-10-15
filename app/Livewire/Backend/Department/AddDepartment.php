<?php

namespace App\Livewire\Backend\Department;

use Livewire\Component;
use App\Models\Department;
class AddDepartment extends Component
{
    public $recordId = null, $title, $description;
    public function render()
    {
        return view('livewire.backend.department.add-department');
    }
    public function mount($recordId=null){
        $this->recordId=$recordId;
        $this->products=$this->recordId ? Department::find($this->recordId) : new Department();
        if ($this->products) {
            $this->title=$this->products->title;
            $this->description=$this->products->description;
        }
    }
    public function store()
    {   
        $product = $this->recordId ? Department::find($this->recordId) : new Department(); // Use Product model
        $product->title = $this->title;
        $product->description = $this->description;
        $product->save();
        session()->flash('message', 'Post successfully updated.');
        return redirect()->route('list-department');
    }
}
