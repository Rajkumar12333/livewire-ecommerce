<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function add_page(){
        return view('Backend.Size.add-size',[
             'page_title'=>'Add Agent'
        ]);
    }
    public function list_page(){
        return view('Backend.Size.list-size');
    }
    public function edit_page($id){
        return view("Backend.Size.add-size",[
            'recordId' => $id,
            'page_title'=>'Edit Agent'
        ]);
    }
}
