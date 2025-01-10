<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
class ProductController extends Controller
{
    public function add_page(){
        return view('Backend.Product.add-product',[
             'page_title'=>'Add Product | Ecommerce'
        ]);
    }
    public function list_page(){
        return view('Backend.Product.list-product',[
               'page_title'=>'List Product | Ecommerce'
        ]);
    }
    public function edit_page($id){
        return view("Backend.Product.add-product",[
            'recordId' => $id,
            'page_title'=>'Edit Product | Ecommerce'
        ]);
    }
    public function destroy($id)
    {
        $post = Product::findOrFail($id);
        $post->delete();
    }
  
    public function getProduct(Request $request)
    {
        // Query the Product model and apply ordering
        $query = Product::query()->orderBy('id', 'desc');
    
        // Apply global search if a search value is provided
        if ($request->has('search') && $searchValue = $request->input('search.value')) {
            $query->where('title', 'like', "%{$searchValue}%"); // Assuming 'title' is the searchable field
        }
    
        // Get total records before pagination
        $totalRecords = $query->count();
    
        // Apply pagination based on 'start' and 'length' parameters from the request
        $products = $query->skip($request->input('start', 0))
                          ->take($request->input('length', 10)) // Default to 10 records per page
                          ->get();
    
        // Return data in the format DataTables expects
        return response()->json([
            'draw' => $request->input('draw'), // Pass through the 'draw' parameter
            'recordsTotal' => $totalRecords, // Total records in the database
            'recordsFiltered' => $totalRecords, // Total records after filtering (you can update this if needed)
            'data' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'description' => $product->description,
                  'image' => '<img src="' . asset('storage/' . ($product->image ?? 'images/default.png')) . '" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">',

                    'action' => '<a class="btn btn-sm btn-primary" href="' . route('edit-products', ['id' => $product->id]) . '">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteProduct(' . $product->id . ')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>',
                ];
            }),
        ]);
    }
    

}
