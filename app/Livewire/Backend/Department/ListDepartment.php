<?php

namespace App\Livewire\Backend\Department;

use Livewire\Component;
use App\Models\Department;
class ListDepartment extends Component
{
    public $isOpen = false,$department=[];
    public function openPopup($id)
    {
        $this->department = Department::find($id); // Make sure product details are fetched
   
        $this->isOpen = true; // Open the popup
    }

    // Event handler to close the popup
    public function closePopup()
    {
        $this->isOpen = false; // Close the popup
    }
    public function render()
    {
        $products=Department::orderBy('id','desc')->get();
        return view('livewire.backend.department.list-department',[
            'products'=>$products
        ]);
    }
    public function delete($id)
    {
        Department::find($id)->delete();
        $this->dispatch('error', 'Department Deleted');
        return redirect()->route('list-department');
    }
}
