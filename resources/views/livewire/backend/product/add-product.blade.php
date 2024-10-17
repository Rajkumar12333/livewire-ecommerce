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
                        <input type="file" wire:model="image">
                        <input type="hidden" wire:model="prev_image">
                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                        <img src="{{'/storage/'.$image}}" height="100px" width="100px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" class="form-control" wire:model="description"></textarea> <!-- Bind with wire:model -->
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="text" class="form-control" wire:model="price">
                        </div>
                        <div class="form-group">
                            <label for="">Department</label>
                            <select wire:model.change="department" id="cars" class="form-control">
                                <option value="">Select Department</option>
                                @foreach($departmentData as $data)
                                <option value="{{$data->id}}">{{$data->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Size</label>
                            <select wire:model.change="size" id="cars">
                                <option value="">Select Size</option>
                                @foreach($sizeData as $data)
                                <option value="{{$data->id}}">{{$data->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Color</label>
                            <select wire:model.change="color" id="cars">
                                <option value="">Select Color</option>
                                @foreach($colorData as $data)
                                <option value="{{$data->id}}">{{$data->title}}</option>
                                @endforeach
                            </select>
              
                        </div>

                        <div class="form-group">
                            <label for="">Seo Title</label>
                           
                            <input type="text" class="form-control" wire:model="seo_title">
                        </div>
                        <div class="form-group">
                            <label for="">Seo Description</label>
                            <input type="text" class="form-control" wire:model="seo_description">
                        </div>
                        <div class="form-group">
                            <label for="">Seo Keywords</label>
                            <input type="text" class="form-control" wire:model="seo_keywords">
                        </div>
                        <button type="submit" class="btn btn-success ms-auto">Save</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
