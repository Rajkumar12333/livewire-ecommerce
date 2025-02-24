<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form wire:submit.prevent="store"> <!-- Use wire:submit.prevent -->
                    <div class="container">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" wire:model="title"> <!-- Bind with wire:model -->
                        </div>
                        <div class="form-group">
                            <label for="">Color code</label>
                            <input type="text" class="form-control" wire:model="color_code"> <!-- Bind with wire:model -->
                        </div>
                       
                        <button type="submit" class="btn btn-success ms-auto">Save</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
