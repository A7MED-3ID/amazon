<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    //

    
    public function AllCoupon(){
        
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.all_coupon',compact("coupons"));

    }//End Method

    public function AddCoupon(){
        
        return view('backend.coupon.add_coupon');

    }//End Method


    public function AddCouponStore(Request $request){
    

        
        Coupon::create([
            "name"=>strtoupper($request->name) ,
            "discount"=>$request->discount,
            "validity"=>$request->validity,
            "created_at"=>Carbon::now()
           
        ]);

       $notification = [
        "message"=>"Coupon Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('coupon.all')->with($notification);


    }// End Method

    public function EditCoupon($id){
        
        $coupon =Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon',compact("coupon"));
    }//End Method


    public function CouponUpdate(Request $request ,$id){
     

        $coupon= Coupon::findOrFail($id);
     
        $coupon->update([
            "name"=>strtoupper($request->name) ,
            "discount"=>$request->discount,
            "validity"=>$request->validity,
            "updated_at"=>Carbon::now()
        ]);




   

       $notification = [
        "message"=>"coupon Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('coupon.all')->with($notification);


    }//End Method 



    
    public function DeleteCoupon($id){
        $coupon= Coupon::findOrFail($id);
        
       $coupon->delete();


       $notification = [
        "message"=>"Coupon Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('coupon.all')->with($notification);
    }// End Method


    
}
