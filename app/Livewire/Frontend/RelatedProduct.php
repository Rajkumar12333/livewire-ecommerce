<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Product,Cart};
use Illuminate\Support\Facades\Auth;
class RelatedProduct extends Component
{
    public $recordId;
    public $relatedProducts=[];
    public $products=[];
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.frontend.related-product');
    }
    public function mount($recordId=null){
        $this->products=Product::where('unique_id',$this->recordId)->first();
        $this->relatedProducts = Product::where('department_id', $this->products->category_id)
                            ->where('id', '!=', $this->products->id) // Exclude the current product
                            ->limit(4)
                            ->get();
                           
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
       
        $this->dispatch('refreshComponent');
       
    }
}
