<?php

namespace App\Livewire\Backend\Department;

use Livewire\Component;
use App\Models\Department;
class ListDepartment extends Component
{
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
