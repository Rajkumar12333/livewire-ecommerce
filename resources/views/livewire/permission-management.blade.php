<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3>Manage Permissions</h3>
                    
                    <input type="text" wire:model="permissionName" placeholder="Enter Permission Name">
                    
                    @if ($isEdit)
                        <button wire:click="updatePermission">Update Permission</button>
                        <button wire:click="resetInput">Cancel</button>
                    @else
                        <button wire:click="addPermission">Add Permission</button>
                    @endif

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <button wire:click="editPermission({{ $permission->id }})">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button wire:click="deletePermission({{ $permission->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (session()->has('message'))
                        <div>{{ session('message') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
