<div>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
    <h3>Manage Roles</h3>
    <div>
        <input type="text" wire:model="roleName" placeholder="Enter Role Name">
        @if ($isEdit)
            <button wire:click="updateRole">Update Role</button>
            <button wire:click="resetInput">Cancel</button>
        @else
            <button wire:click="addRole">Add Role</button>
        @endif
    </div>

    <ul>
    <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        @foreach ($roles as $role)

                <tr>
                    <td> {{ $role->name }}</td>
                    <td>
                    <button wire:click="editRole({{ $role->id }})"><i class="fa-solid fa-pen-to-square"></i></button>

                      <button wire:click="deleteRole({{ $role->id }})"> <i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
           
         
        @endforeach
        </tbody>

</table>
    </ul>

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
</div>
</div>
</div>
</div>
</div>