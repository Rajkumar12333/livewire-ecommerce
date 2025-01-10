<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function list_page(){
        return view('Backend.Contact.list-contact',[
             'page_title'=>'Contact Leads | Ecommerce'
        ]);
    }
    public function getContact(Request $request)
    {
        // Initialize the search term
        $search = $request->input('search.value');
    
        // Start building the query
        $query = Contact::query()->orderBy('id', 'desc');
    
        // Apply the search filter if there is any
        if ($search != '') {
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('message', 'LIKE', "%{$search}%");
        }
    
        // Get paginated results: `start` is the offset, `length` is the number of records per page
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $sizes = $query->skip($start)->take($length)->get();
    
        // Total records count (without search filter)
        $total = Contact::count(); // Total count without filters
        
        // Records filtered count (after applying search filter)
        $filteredTotal = $query->count(); // Count with search filter applied
    
        // Prepare the data for response
        $data = $sizes->map(function ($size) {
            return [
                'id' => $size->id,
                'name' => $size->name,
                'email' => $size->email,
                'message' => $size->message,
            ];
        });
    
        // Return JSON response
        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $filteredTotal, // Return the filtered count
            'data' => $data
        ]);
    }
        
}
