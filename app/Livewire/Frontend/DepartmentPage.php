<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\{Department,Product,Cart};
use Illuminate\Support\Facades\Auth;
class DepartmentPage extends Component
{
    public $departments=[],$products=[];
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function render()
    {
        return view('livewire.frontend.department');
    }

    public function mount($slug){
        $this->departments=Department::orderBy('id','desc')->get();
        $this->departmentFetch=Department::where('slug',$slug)->first();
       
        $this->products=Product::where('department_id',$this->departmentFetch->id)->get();
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
       
        $this->dispatch('refreshComponent');
       
    }
}
