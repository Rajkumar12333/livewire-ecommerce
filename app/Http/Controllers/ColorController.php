<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Color;
class ColorController extends Controller
{
    public function add_page(){
        return view('Backend.Color.add-color',[
             'page_title'=>'Add Agent'
        ]);
    }
    public function list_page(){
        return view('Backend.Color.list-color');
    }
    public function edit_page($id){
        return view("Backend.Color.add-color",[
            'recordId' => $id,
            'page_title'=>'Edit Agent'
        ]);
    }
}
