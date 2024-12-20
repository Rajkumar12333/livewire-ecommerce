<?php

namespace App\Livewire\Frontend;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\{Department,Color,Product,Size,Cart};
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
            $query->where('department_id', $this->category);
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
        $this->loadCart();
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
    public function addToCart($productId)
    {
        $product = Product::find($productId);
   
        if (!$product) {
            $this->dispatch('error', 'Product not found.');
            return;
        }

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();
        
        if ($cartItem) {
            // If the product is already in the cart, update the quantity
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            // If it's a new product, add it to the cart
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        $this->dispatch('success', 'Product added to cart');
        $this->loadCart();
        $this->dispatch('refreshComponent');
       
    }
    public function loadCart()
    {
        $this->cart = Cart::where('user_id', Auth::id())->with('product')->get();
    }


}
