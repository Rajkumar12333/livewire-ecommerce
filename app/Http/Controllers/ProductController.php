<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Product;
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
}
