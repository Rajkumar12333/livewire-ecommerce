<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
class ProductController extends Controller
{
    public function add_page(){
        return view('Backend.Product.add-product',[
             'page_title'=>'Add Agent'
        ]);
    }
    public function list_page(){
        return view('Backend.Product.list-product');
    }
    public function edit_page($id){
        return view("Backend.Product.add-product",[
            'recordId' => $id,
            'page_title'=>'Edit Agent'
        ]);
    }
    public function destroy($id)
    {
        $post = Product::findOrFail($id);
        $post->delete();
    }
    public function getProduct(Request $request)
    {
        $Product = Product::query();

        return DataTables::of($Product)
            ->addColumn('image', function ($Product) {
                $imagePath = asset('storage/' . $Product->image); // Adjust path as needed
                return '<img src="' . $imagePath . '" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">';
            })
            ->addColumn('action', function ($Product) {
                return '<a class="btn btn-sm btn-primary" href="' . route('edit-products', ['id' => $Product->id]) . '" wire:navigate><i class="fa-solid fa-pen-to-square"></i></a>
                <button type="button" class="btn btn-sm btn-danger" wire:click.prevent="delete(' . $Product->id . ')">
                    <i class="fa-solid fa-trash"></i>
                </button>';
            })
            ->rawColumns(['image', 'action']) // Ensure the image and action columns render HTML
            ->make(true);
    }

}
