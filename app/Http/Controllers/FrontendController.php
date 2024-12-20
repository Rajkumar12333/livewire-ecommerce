<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class FrontendController extends Controller
{
    public function shop(){
        return view("Frontend.shop");
    }
    public function index(){
        $departments=Department::orderBy('id','desc')->get();
        return view("Frontend.index",compact('departments'));
    }
    public function contact(){
        return view("Frontend.contact");
    }
    public function shop_detail($id){
        return view("Frontend.shop-detail",[
            'recordId'=>$id
        ]);
    }
    public function shoping_cart(){
        return view("Frontend.shoping-cart");
    }
    public function checkout(){
        return view("Frontend.checkout");
    }

    public function department($slug){
        return view("Frontend.department",['slug'=>$slug]);
    }


}

