<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function getCart(Request $request)
    {
        $query= Cart::where('user_id', Auth::id())->with('product');
    
        // Apply search filter
        // if ($request->has('search') && $request->input('search.value') !== '') {
        //     $search = $request->input('search.value');
        //     $query->where('title', 'LIKE', "%{$search}%");
        // }
    
        // Clone the query to count total records after applying filters
        $totalRecords = $query->count();
    
        // Apply pagination
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $products = $query->skip($start)->take($length)->get();
    
        // Format data with the action column
        $data = $products->map(function ($product) {


         
            return [
                'id' => $product->id,
                'title' => $product->title ,
                'image' => '<img src="' . asset('storage/' . ($product->image ?? 'images/default.png')) . '" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">',
                'price' => $product->price,
                'action'=>'<a target="_blank" href="' . route('shop-detail', ['id' => $product->unique_id]) . '" ><i class="fa-solid fa-link"></i></a>'
            ];
        });
    
        // Return JSON response
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Update if more filters are added in the future
            'data' => $data
        ]);
    }
}
