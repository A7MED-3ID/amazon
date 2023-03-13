<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //
    public function addToCart(Request $request,$id){
        $product = Product::findOrFail($id);

        if(Session::has('coupon')){
            Session::forget('coupon');

        }

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,

                ],
            ]);

     return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }else{

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,

                   
                ],
            ]);

     return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }
    }//End Method 



    public function miniCart(){

        $carts = Cart::content();
        $cartsqty=Cart::count();
        $cartTotal=Cart::total();


        return response()->json([
            "carts"=>$carts,
            "cartsqty"=>$cartsqty,
            "cartTotal"=>$cartTotal

        ]);





    }//End Method 


    public function miniCartRemove($rowId){

        Cart::remove($rowId);

        return response()->json(["success"=>"Product Removed Successfully"]);
        
    }//End Method 

    public function addToCartDetails(Request $request ,$id){
        if(Session::has('coupon')){
            Session::forget('coupon');

        }


        $product = Product::findOrFail($id);

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,

                ],
            ]);

     return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }else{

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,

                   
                ],
            ]);

     return response()->json(['success' => 'Successfully Added on Your Cart' ]);

        }


    }//End Method 


    public function MyCart(){

        return view('frontend.cart.view_mycart');

    }//End Method 


    public function GetCartProducts(){

        $carts = Cart::content();
        $cartsqty=Cart::count();
        $cartTotal=Cart::total();


        return response()->json([
            "carts"=>$carts,
            "cartsqty"=>$cartsqty,
            "cartTotal"=>$cartTotal

        ]);



    }//End Method 


    public function RemoveCartProduct($rowId){

        Cart::remove($rowId);
        
        if(Session::has('coupon')){
            $coupon_name=Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where("name",$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name'=>$coupon->name,
                'coupon_discount'=>$coupon->discount,
                'discount_amount'=>round(Cart::total()* $coupon->discount / 100),
                'total_amount'=>round(Cart::total()- (Cart::total()* $coupon->discount / 100))



            ]);
        }

        return response()->json(["success"=>"Product Removed Successfully"]);

    }//End Method 

    public function CartIncrement($id){
        $row=Cart::get($id);
        Cart::update($id,$row->qty+1);


        if(Session::has('coupon')){
            $coupon_name=Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where("name",$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name'=>$coupon->name,
                'coupon_discount'=>$coupon->discount,
                'discount_amount'=>round(Cart::total()* $coupon->discount / 100),
                'total_amount'=>round(Cart::total()- (Cart::total()* $coupon->discount / 100))



            ]);
        }

        return response()->json("Increment");

    }//End Method 


    
    public function CartDecrement($id){
        $row=Cart::get($id);
        Cart::update($id,$row->qty-1);
        if(Session::has('coupon')){
            $coupon_name=Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where("name",$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name'=>$coupon->name,
                'coupon_discount'=>$coupon->discount,
                'discount_amount'=>round(Cart::total()* $coupon->discount / 100),
                'total_amount'=>round(Cart::total()- (Cart::total()* $coupon->discount / 100))



            ]);
        }

        return response()->json("Decrement");

    }//End Method


    public function ApplyCoupon(Request $request){

        $coupon = Coupon::where("name",$request->coupon_name)->where("validity",">=",Carbon::now()->format('Y-m-d'))->first();

        if($coupon){
            Session::put('coupon',[
                'coupon_name'=>$coupon->name,
                'coupon_discount'=>$coupon->discount,
                'discount_amount'=>round(Cart::total()* $coupon->discount / 100),
                'total_amount'=>round(Cart::total()- (Cart::total()* $coupon->discount / 100))



            ]);

            return response()->json([
                'success'=>"coupon applied successflly",
                "validity"=>true
        ]);
        }else{
            return response()->json(['error'=>"Invalid  coupon "]);

        }

    }//End Method


    public function CouponCalculation(){

        if(Session::has('coupon')){

            return response()->json([
                "subtotal"=>Cart::total(),
                'coupon_name'=>session()->get('coupon')['coupon_name'],
                'coupon_discount'=>session()->get('coupon')['coupon_discount'],
                'discount_amount'=>session()->get('coupon')['discount_amount'],
                'total_amount'=>session()->get('coupon')['total_amount'],




            ]);
        }else{
            return response()->json(['total'=>Cart::total()]);
        }

    }//End Method


    public function couponRemove(){

        Session::forget('coupon');

        return response()->json(['success'=>"Coupon Removed Successfully"]);

    }//End Method

    public function CheckoutCreate(){

        if(Auth::check()){

            if(Cart::total()>0){
                
        $carts = Cart::content();
        $cartsqty=Cart::count();
        $cartTotal=Cart::total();
        $divisions =ShipDivision::orderBy("name","ASC")->get();
        $districts = ShipDistricts::orderBy('name',"ASC")->get();


        return view('frontend.checkout.checkout_view',compact("carts","cartsqty","cartTotal","divisions","districts"));



            }else{
                $notification = [
                    "message"=>"Buy At Least One Item",
                    "alert-type"=>"error"
                  ];
            
                 return redirect()->to('/')->with($notification);

            }

        }else{

            $notification = [
                "message"=>"Login First !!!",
                "alert-type"=>"error"
              ];
        
             return redirect()->route('login')->with($notification);
        

        }

    }//End Method
    
}
