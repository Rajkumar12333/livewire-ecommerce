<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Department,Color,Product,Size};
use Livewire\WithPagination;
class Shop extends Component
{
    use WithPagination;
    public $category = null;
    public $color = null;
    public $size = null;

    public $department=[];
    public $colors=[];
    public $product=[];
    public $sizes=[];
    public $latest_product=[];
    public function render()
    {
        $query = Product::query();

        if ($this->category) {
            $query->where('department_id', 2);
        }

        if ($this->color) {
            $query->where('color_id', $this->color);
        }

        if ($this->size) {
            $query->where('size_id', $this->size);
        }

        $this->product = $query->orderBy('id', 'desc')->get();

        return view('livewire.frontend.shop',[
            'department'=>$this->department,
            'colors'=>$this->colors,
            'product'=>$this->product,
            'sizes'=>$this->sizes,
            // 'latest_product'=>$this->latest_product
        ]);
    }
    public function mount(){
        $this->category = request()->get('category', null);
        $this->color = request()->get('color', null);
        $this->size = request()->get('size', null);

        $this->department=Department::orderBy('id','desc')->get();
        $this->colors=Color::orderBy('id','desc')->get();
      
        $this->latest_product = Product::orderBy('id', 'desc')->take(6)->get();
        $this->sizes=Size::orderBy('id','desc')->get();
        
    }
    public function updatedCategory($value)
    {
        $this->filterProducts();
    }

    public function updatedColor($value)
    {
        $this->filterProducts();
    }

    public function updatedSize($value)
    {
        $this->filterProducts();
    }
    public function filterProducts()
    {
        // // Start building the query
        // $query = Product::query();
    
        // // Apply filters if they exist
        // if ($this->category) {
        //     $query->where('department_id', $this->category);
        // }
        // if ($this->color) {
        //     $query->where('color_id', $this->color);
        // }
        // if ($this->size) {
        //     $query->where('size_id', $this->size);
        // }
    
        // // Output the SQL query string for debugging
        // // dd($query->toSql(), $query->getBindings());
    
        // // Execute the query and update the products list
        // $this->product = $query->get();
    
        // // For debugging, you can uncomment the following line
        // // dd($this->product);
    }
    
}
