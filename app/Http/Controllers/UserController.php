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
            ->addColumn('action', function ($user) {
                return '</button>
                                  <button type="button" class="btn btn-sm btn-info" wire:click="openPopup(' . $user->id . ')">
                                <i class="fa-solid fa-eye"></i>
                            </button>';
            })
            ->rawColumns(['action']) // Ensure the action column renders HTML
            ->make(true);
    }
    
}
