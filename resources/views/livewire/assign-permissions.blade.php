<div>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
<div class="p-6 text-gray-900">
    <h3>Assign Permissions</h3>
    <select wire:model.live="roleId">
        <option value="">Select a Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>

    <h4>Permissions</h4>
    <div>
        @foreach($permissions as $permission)
            <label>
                <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}">
                {{ $permission->name }}
            </label>
        @endforeach
    </div>

    <button wire:click="assignPermissions">
        Assign Permissions
    </button>

    @if (session()->has('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif
</div>
</div>
</div>
</div>
</div>
