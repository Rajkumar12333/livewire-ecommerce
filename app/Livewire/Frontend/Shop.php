<?php

namespace App\Livewire\Frontend;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\{Department,Color,Product,Size,Cart,Wishlist};
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    public $category = null;
    public $color = null;
    public $size = null;
    public $sortOrder = ''; 

    public $department=[];
    public $wishlistItems = [];
    public $colors=[];
    public $product=[];
    public $sizes=[];
    public $latest_product=[];
    public $minPrice = 1;
    public $maxPrice = 600;
    protected $listeners = ['refreshComponent' => '$refresh'];
    // public function placeholder()
    // {
    //     return <<<'HTML'
    //         <div>
    //             <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    //                 <div class="spinner-border text-primary" role="status">
    //                     <span class="visually-hidden"></span>
    //                 </div>
    //             </div>
    //         </div>
    //     HTML;
    // }
    public function render()
    {
       
        $query = Product::query();
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
        if ($this->category) {
            $query->where('department_id', $this->category);
        }

        if ($this->color) {
            $query->where('color_id', $this->color);
        }

        if ($this->size) {
            $query->where('size_id', $this->size);
        }
      
        if ($this->sortOrder) {
            $query->orderBy('title', $this->sortOrder);
        }else{
            $query->orderBy('id', "DESC");
        }

        $this->product = $query->get();

        return view('livewire.frontend.shop');
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
        $this->wishlistItems = \App\Models\Wishlist::where('user_id', auth()->id())
        ->pluck('product_id')
        ->toArray();
    }
    public function updatedCategory($value)
    {
        $this->filterProducts();
    }

    public function colorChange($value)
    {
        $this->color=$value;
        $this->filterProducts();
    }

    public function changeSize($value)
    {
        $this->size=$value;
        $this->filterProducts();
    }
    public function updatedMinPrice($value)
    {
      
        $this->filterProducts();
    }
    public function changeOrder($value)
    {
        $this->sortOrder = $value; // Update the sortOrder directly
        $this->filterProducts(); // Apply your filtering logic
    }
    public function filterProducts()
    {
        // Start building the query
        $query = Product::query();
     
        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
        // Apply filters if they exist
        if ($this->category) {
            $query->where('department_id', $this->category);
        }
        if ($this->color) {
            $query->where('color_id', $this->color);
        }
        if ($this->size) {
            $query->where('size_id', $this->size);
        }
        if ($this->sortOrder) {
            $query->orderBy('title', $this->sortOrder);
        }

        // Output the SQL query string for debugging
        // dd($query->toSql(), $query->getBindings());
    
        // Execute the query and update the products list
        $this->product = $query->get();
    
        // For debugging, you can uncomment the following line
        // // dd($this->product);
    }
    public function addToCart($productId)
    {
        if (!Auth::check()) {
            $this->dispatch('error', 'Please log in to purchase this product.');
            return;
        }
       
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
        $this->dispatch('reloadPage');
    }
    public function loadCart()
    {
        $this->cart = Cart::where('user_id', Auth::id())->with('product')->get();
    }
    public function addToWishlist($productId)
    {
        if (!Auth::check()) {
            $this->dispatch('error', 'Please log in to purchase this product.');
            return;
        }
       
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $productId,
        ]);

        $this->products = auth()->user()->wishlistProducts;
        $this->dispatch('success', 'Product added to Whishlist');
        $this->loadCart();
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }
    public function removeFromWishlist($productId)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();

        $this->products = auth()->user()->wishlistProducts;
        $this->dispatch('error', 'Product Removed to Whishlist');
        $this->loadCart();
        $this->dispatch('refreshComponent');
        $this->dispatch('reloadPage');
    }
    public function toggleWishlist($productId)
    {
        if (in_array($productId, $this->wishlistItems)) {
            // If the product is already in the wishlist, remove it
            $this->removeFromWishlist($productId);
        } else {
            // If the product is not in the wishlist, add it
            $this->addToWishlist($productId);
        }
        $this->wishlistItems = \App\Models\Wishlist::where('user_id', auth()->id())
        ->pluck('product_id')
        ->toArray();
    }
    
    public function resetValues(){
        $this->size="";
        $this->category="";
        $this->color="";
        $this->minPrice=1;
        $this->maxPrice=600;
        $this->sortOrder="";
        $this->dispatch('resetSliderValues');
    }
    
}
