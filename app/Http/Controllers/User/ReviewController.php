<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // ///////// User  //////////

    public function StoreReview($product_id , Request $request){


        $request->validate([
            "comment"=>'required'
        ]);

        Review::insert([
            "product_id"=>$product_id,
            "user_id"=>Auth::id(),
            "comment"=>$request->comment,
            "rating"=>$request->quality,
            "vendor_id"=>$request->hvendor_id,
            "created_at"=>Carbon::now()
        ]);

        $notification = [
            "message"=>"Your Review Will Approve By Admin ",
            "alert-type"=>"success"
        ];

        return redirect()->back()->with($notification);

    }//End Method

    ////////////////// Admin //////////////

    public function PendingReview(){

        $reviews = Review::where("status",0)->latest()->get();

        return view('backend.review.pending_review',compact('reviews'));

    }//End Method

    public function ApproveReview($id){

        Review::findOrFail($id)->update(["status"=>1]);

        
        $notification = [
            "message"=>"Review Approved Successfully ",
            "alert-type"=>"success"
        ];

        return redirect()->route('publish.review')->with($notification);

    }//End Method

    public function PublishReview(){

        $reviews = Review::where("status","!=",0)->latest()->get();

        return view('backend.review.publish_review',compact('reviews'));

    }//End Method

    public function DeleteReview($id){

        $review = Review::findOrFail($id);

        $review->delete();


        $notification = [
            "message"=>" Review Deleted Successfully ",
            "alert-type"=>"success"
        ];

        return redirect()->back()->with($notification);

    }//End Method






    /////////////////// Vendor Methods ///////////////////

    public function AllReview(){

        $reviews = Review::where("vendor_id",Auth::id())->where("status",1)->latest()->get();

        return view('vendor.review.approve_review',compact("reviews"));

    }//End Method
}
