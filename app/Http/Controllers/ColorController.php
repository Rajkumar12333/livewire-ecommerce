<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Yajra\DataTables\Facades\DataTables;
class ColorController extends Controller
{
    public function add_page(){
        return view('Backend.Color.add-color',[
        
             'page_title'=>'Add Color | Ecommerce'
        ]);
    }
    public function list_page(){
        return view('Backend.Color.list-color',[
             'page_title'=>'List Color | Ecommerce'
        ]);
    }
    public function edit_page($id){
        return view("Backend.Color.add-color",[
            'recordId' => $id,
            'page_title'=>'Edit Color | Ecommerce'
        ]);
    }

    public function getColor(Request $request)
    {
        $query = Color::query()->orderBy('id', 'desc');

        // Apply search filter
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where('title', 'LIKE', "%{$search}%");
        }

        // Get paginated results
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $colors = $query->skip($start)->take($length)->get();

        // Total records count
        $total = $query->count();

        // Add the 'action' column dynamically
        $data = $colors->map(function ($color) {
            return [
                'id' => $color->id,
                'title' => $color->title,
                'action' => '<a class="btn btn-sm btn-primary" href="' . route('edit-color', ['id' => $color->id]) . '" wire:navigate><i class="fa-solid fa-pen-to-square"></i></a>
                            <button type="button" class="btn btn-sm btn-danger" wire:click.prevent="delete(' . $color->id . ')">
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
