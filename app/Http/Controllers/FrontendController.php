<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function shop(){
        return view("Frontend.shop");
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

}

