<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
class SizeController extends Controller
{
    public function add_page(){
        return view('Backend.Size.add-size',[
             'page_title'=>'Add SIze | Ecommerce'
        ]);
    }
    public function list_page(){
        return view('Backend.Size.list-size',[
             'page_title'=>'List Size | Ecommerce'
        ]);
    }
    public function edit_page($id){
        return view("Backend.Size.add-size",[
            'recordId' => $id,
            'page_title'=>'Edit Size | Ecommerce'
        ]);
    }
    public function getSize(Request $request)
    {
        $query = Size::query()->orderBy('id', 'desc');
    
        // Apply search filter
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where('title', 'LIKE', "%{$search}%");
        }
    
        // Get paginated results
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $sizes = $query->skip($start)->take($length)->get();
    
        // Total records count
        $total = $query->count();
    
        // Add the 'action' column dynamically
        $data = $sizes->map(function ($size) {
            return [
                'id' => $size->id,
                'title' => $size->title,
                'action' => '<a class="btn btn-sm btn-primary" href="' . route('edit-color', ['id' => $size->id]) . '" wire:navigate><i class="fa-solid fa-pen-to-square"></i></a>
                             <button type="button" class="btn btn-sm btn-danger" wire:click.prevent="delete(' . $size->id . ')">
                                 <i class="fa-solid fa-trash"></i>
                             </button>',
            ];
        });
    
        // Return JSON response
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $total, // Update this if you apply additional filters
            'data' => $data
        ]);
    }
}
