<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function list_page(){
        return view('Backend.Contact.list-contact');
    }
}
