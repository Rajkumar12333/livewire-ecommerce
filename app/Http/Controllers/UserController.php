<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
class UserController extends Controller
{
    public function list_page(){
       
        return view('Backend.Users.users-data-table',[
             'page_title'=>'List Users'
        ]);
    }
    public function getUsers(Request $request)
    {
        $users = User::query();
    
        return DataTables::of($users)
            // ->addColumn('action', function ($user) {
            //     return '<a class="btn btn-sm btn-primary" href="' . route('edit-user', ['id' => $user->id]) . '">Edit</a>';
            // })
            // ->rawColumns(['action']) // Ensure the action column renders HTML
            ->make(true);
    }
    
}
