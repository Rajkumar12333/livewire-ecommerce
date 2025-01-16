<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
class RoleManagement extends Component
{
    public $roles, $roleName,$editRoleId, $isEdit = false;

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function addRole()
    {
        $this->validate(['roleName' => 'required|unique:roles,name']);
        Role::create(['name' => $this->roleName]);
        $this->roles = Role::all();
        $this->roleName = '';
        session()->flash('message', 'Role added successfully!');
    }

    public function deleteRole($id)
    {
        Role::find($id)->delete();
        $this->roles = Role::all();
        session()->flash('message', 'Role deleted successfully!');
    }
    public function editRole($id)
    {
      
        $role = Role::findOrFail($id);
        $this->editRoleId = $role->id;
        $this->roleName = $role->name;
        $this->isEdit = true;
       
    }

    public function updateRole()
    {
        $this->validate(['roleName' => 'required|unique:roles,name,' . $this->editRoleId]);

        $role = Role::findOrFail($this->editRoleId);
        $role->update(['name' => $this->roleName]);

        $this->roles = Role::all();
        $this->resetInput();
        session()->flash('message', 'Role updated successfully!');
    }

    public function resetInput()
    {
        $this->roleName = '';
        $this->editRoleId = null;
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.role-management')->layout('layouts.app');
    }
}
