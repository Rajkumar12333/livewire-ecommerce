<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\Product; // Make sure you import the correct Product model
use Illuminate\Support\Str;
use Toaster; 
class AddProduct extends Component
{
    public $recordId = null, $title, $description,$price,$seo_title,$seo_description,$seo_keywords;
    public $products=[];
    public function render()
    {
        return view('livewire.backend.product.add-product');
    }
    public function mount($recordId=null){
        //dd($recordId);
        $this->recordId=$recordId;
        $this->products=$this->recordId ? Product::find($this->recordId) : new Product();
        if ($this->products) {
            $this->title=$this->products->title;
            $this->description=$this->products->description;
            $this->unique_id=$this->products->unique_id;
            $this->price=$this->products->price;
            $this->seo_title=$this->products->seo_title;
            $this->seo_description=$this->products->seo_description;
            $this->seo_keywords=$this->products->seo_keywords;
           
        }

    }
    public function store()
    {
        $uuid = Str::uuid();
        
        $product = $this->recordId ? Product::find($this->recordId) : new Product(); // Use Product model
        $product->title = $this->title;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->seo_title = $this->seo_title;
        $product->seo_description = $this->seo_description;
        $product->seo_keywords = $this->seo_keywords;
        $product->unique_id = $uuid;
        $product->save();


        session()->flash('message', 'Post successfully updated.');

        return redirect()->route('list-products');
    }
    

}
