<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
class PermissionManagement extends Component
{
    public $permissions, $permissionName, $editPermissionId, $isEdit = false;

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function addPermission()
    {
        $this->validate(['permissionName' => 'required|unique:permissions,name']);
        Permission::create(['name' => $this->permissionName]);
        $this->permissions = Permission::all();
        $this->permissionName = '';
        session()->flash('message', 'Permission added successfully!');
    }

    public function deletePermission($id)
    {
        Permission::find($id)->delete();
        $this->permissions = Permission::all();
        session()->flash('message', 'Permission deleted successfully!');
    }
    public function editPermission($id)
    {
        $permission = Permission::findOrFail($id);
        $this->editPermissionId = $permission->id;
        $this->permissionName = $permission->name;
        $this->isEdit = true;
    }

    public function updatePermission()
    {
        $this->validate(['permissionName' => 'required|unique:permissions,name,' . $this->editPermissionId]);

        $permission = Permission::findOrFail($this->editPermissionId);
        $permission->update(['name' => $this->permissionName]);

        $this->permissions = Permission::all();
        $this->resetInput();
        session()->flash('message', 'Permission updated successfully!');
    }
    public function resetInput()
    {
        $this->permissionName = '';
        $this->editPermissionId = null;
        $this->isEdit = false;
    }
    public function render()
    {
        return view('livewire.permission-management')->layout('layouts.app');
    }
}
