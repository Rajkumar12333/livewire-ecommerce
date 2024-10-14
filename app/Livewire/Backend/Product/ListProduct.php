<?php

namespace App\Livewire\Backend\Product;

use Livewire\Component;
use App\Models\Product;
class ListProduct extends Component
{
    public $deleteId = '';
    protected $listeners = [
        'refreshComponent' => '$refresh',
    ];
    public function render()
    {
        $products=Product::orderBy('id','desc')->get();
        return view('livewire.backend.product.list-product',[
            'products'=>$products
        ]);
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function delete()
    {
        User::find($this->deleteId)->delete();
    }
}
