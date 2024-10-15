<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Department;
class DepartmentController extends Controller
{
    public function add_page(){
        return view('Backend.Department.add-department',[
             'page_title'=>'Add Agent'
        ]);
    }
    public function list_page(){
        return view('Backend.Department.list-department');
    }
    public function edit_page($id){
        return view("Backend.Department.add-department",[
            'recordId' => $id,
            'page_title'=>'Edit Agent'
        ]);
    }
}
