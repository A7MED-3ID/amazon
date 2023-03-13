<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Http\Controllers\Controller;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    //

    public function LoadDistrict($division_id){

        $districts = ShipDistricts::where("division_id",$division_id)->orderBy("name","ASC")->get();
        return json_encode($districts);

    }//End Method

    public function LoadState($district_id){
        $states = ShipState::where("district_id",$district_id)->orderBy("name","ASC")->get();
        return json_encode($states);

    }//End Method


    public function CheckoutStore(Request $request){
        $data = $request;
        $cart_total = Cart::total();

           


        if($request->payment_option =="stripe"){

            return view('frontend.payment.stripe',compact("data","cart_total"));
        }elseif($request->payment_option =="cash"){
            return view('frontend.payment.cash',compact("data","cart_total"));

            
        }else{
            return view('frontend.payment.cash',compact("data","cart_total"));


        }

    }//End Method


  


}
