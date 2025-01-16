<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AssignPermissions extends Component
{
    public $roles, $permissions, $selectedRole, $selectedPermissions = [], $roleId;

    public function mount()
    {
        $this->roles = Role::all();
        $this->permissions = Permission::all();
    }

    public function updatedRoleId($value)
    {
        if (!$value) {
            $this->selectedPermissions = [];
            return;
        }

        $role = Role::find($value);

        if ($role) {
            // Fetch assigned permissions and map to IDs
            $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        } else {
            $this->selectedPermissions = [];
        }

        // Debugging: Uncomment for testing
        // dd($this->selectedPermissions);
    }

    public function assignPermissions()
    {
        if (!$this->roleId) {
            session()->flash('error', 'Please select a role.');
            return;
        }

        $role = Role::find($this->roleId);

        if (!$role) {
            session()->flash('error', 'Role not found.');
            return;
        }

        // Fetch permission names from selected IDs
        $permissions = Permission::whereIn('id', $this->selectedPermissions)->pluck('name');

        if ($permissions->isEmpty()) {
            session()->flash('error', 'No valid permissions selected.');
            return;
        }

        // Sync permissions with the role
        $role->syncPermissions($permissions);

        session()->flash('success', 'Permissions assigned successfully!');
    }

    public function render()
    {
        return view('livewire.assign-permissions')->layout('layouts.app');
    }
}
