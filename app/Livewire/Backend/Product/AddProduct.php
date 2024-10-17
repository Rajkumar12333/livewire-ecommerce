<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\{Product,Department,Color,Size}; // Make sure you import the correct Product model
use Illuminate\Support\Str;
use Livewire\WithFileUploads; // Import the file upload trait
use Illuminate\Support\Facades\Storage;
class AddProduct extends Component
{
    use WithFileUploads;
    public $departmentData=[];
    public $colorData=[];
    public $sizeData=[];
    public $recordId = null, $title, $description,$price,$seo_title,$seo_description,$seo_keywords,$department,$size,$color,$image,$prev_image;
    public $products=[];
    public function render()
    {
        return view('livewire.backend.product.add-product');
    }
    public function mount($recordId=null){
        $this->departmentData=Department::orderBy('id','desc')->get();
        $this->colorData=Color::orderBy('id','desc')->get();
        $this->sizeData=Size::orderBy('id','desc')->get();
        $this->recordId=$recordId;
        $this->products=$this->recordId ? Product::find($this->recordId) : new Product();
        if ($this->products) {
            $this->title=$this->products->title;
            $this->description=$this->products->description;
            $this->unique_id=$this->products->unique_id;
            $this->price=$this->products->price;
            $this->department=$this->products->department_id;
            $this->size=$this->products->size_id;
            $this->color=$this->products->color_id;
            $this->seo_title=$this->products->seo_title;
            $this->seo_description=$this->products->seo_description;
            $this->seo_keywords=$this->products->seo_keywords;
            $this->image=$this->products->image;
            $this->prev_image=$this->products->image;
           
        }

    }
    public function store()
    {
        $uuid = Str::uuid();
        if ($this->image && is_object($this->image)) {
            // If a new image is uploaded, store it
            $path = $this->image->store('images', 'public');
        } else {
            // If no new image is uploaded, keep the previous image from the database
            $path = $this->prev_image;
        }
       
        $product = $this->recordId ? Product::find($this->recordId) : new Product(); // Use Product model
        $product->title = $this->title;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->department_id = $this->department;
        $product->color_id = $this->color;
        $product->size_id = $this->size;
        $product->seo_title = $this->seo_title;
        $product->seo_description = $this->seo_description;
        $product->seo_keywords = $this->seo_keywords;
        $product->unique_id = $uuid;
        $product->image=$path;
        $product->save();


        session()->flash('message', 'Post successfully updated.');

        return redirect()->route('list-products');
    }
    

}
