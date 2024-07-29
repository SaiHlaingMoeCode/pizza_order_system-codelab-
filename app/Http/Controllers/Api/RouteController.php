<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product lists
    public function productList(){
        $products=Product::get();
        $user=User::get();

        $data=[
            'product'=>$products,
            'user'=>$user
        ];
        return response()->json($data,200);


    }

    //get all contact list
    public function contactList(){
        $contacts=Contact::get();
        return response()->json($contacts, 200);
    }
}
