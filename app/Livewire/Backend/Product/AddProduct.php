<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\Product; // Make sure you import the correct Product model
use Illuminate\Support\Str;

class AddProduct extends Component
{
    public $recordId = null, $title, $description;

    public function render()
    {
        return view('livewire.backend.product.add-product');
    }

    public function store()
    {
        $uuid = Str::uuid();
        
        $product = $this->recordId ? Product::find($this->recordId) : new Product(); // Use Product model
        $product->title = $this->title;
        $product->description = $this->description;
        $product->unique_id = $uuid;
        $product->save();

        // Optionally, you can reset the form after saving
        $this->reset(['title', 'description']);
    }
}
