<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Yajra\DataTables\Facades\DataTables;
class DepartmentController extends Controller
{
    public function add_page(){
        return view('Backend.Department.add-department',[
             'page_title'=>'Add Department | Ecommerce'
        ]);
    }
    public function list_page(){
        return view('Backend.Department.list-department',[
             'page_title'=>'List Department | Ecommerce'
        ]);
    }
    public function edit_page($id){
        return view("Backend.Department.add-department",[
            'recordId' => $id,
            'page_title'=>'Edit Department | Ecommerce'
        ]);
    }
    // public function getDepartment(Request $request)
    // {
    //     $Department = Department::query();

    //     return DataTables::of($Department)
    
    //         ->addColumn('action', function ($Department) {
    //             return '<a class="btn btn-sm btn-primary" href="' . route('edit-department', ['id' => $Department->id]) . '" wire:navigate><i class="fa-solid fa-pen-to-square"></i></a>
    //             <button type="button" class="btn btn-sm btn-danger" wire:click.prevent="delete(' . $Department->id . ')">
    //                 <i class="fa-solid fa-trash"></i>
    //             </button>';
    //         })
    //         ->rawColumns([ 'action']) // Ensure the image and action columns render HTML
    //         ->make(true);
    // }
    public function getDepartment(Request $request)
    {
        // Query the Department model and apply ordering
        $query = Department::query()->orderBy('id', 'desc');
    
        // Apply global search if a search value is provided
        if ($request->has('search') && $searchValue = $request->input('search.value')) {
            $query->where('title', 'like', "%{$searchValue}%"); // Assuming 'name' is the searchable field
        }
    
        // Get total records before pagination
        $totalRecords = $query->count();
    
        // Apply pagination based on 'start' and 'length' parameters from the request
        $departments = $query->skip($request->input('start', 0))
                             ->take($request->input('length', 10)) // Default to 10 records per page
                             ->get();
    
        // Return data in the format DataTables expects
        return response()->json([
            'draw' => $request->input('draw'), // Pass through the 'draw' parameter
            'recordsTotal' => $totalRecords, // Total records in the database
            'recordsFiltered' => $totalRecords, // Total records after filtering (you can update this if needed)
            'data' => $departments->map(function ($department) {
                return [
                    'id' => $department->id,
                    'title' => $department->title, // Assuming 'name' is a field in the 'departments' table
                    'action' => '<a class="btn btn-sm btn-primary" href="' . route('edit-department', ['id' => $department->id]) . '">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="delete(' . $department->id . ')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                </button>
                                  <button type="button" class="btn btn-sm btn-info" wire:click="openPopup(' . $department->id . ')">
                                <i class="fa-solid fa-eye"></i>
                            </button>',
                ];
            }),
        ]);
    }
    

}
