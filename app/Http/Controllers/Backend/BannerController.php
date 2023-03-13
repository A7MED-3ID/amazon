<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    //

    
    public function AllBanners(){
        
        $banners = Banner::latest()->get();
        return view('backend.banner.all_banner',compact("banners"));

    }//End Method


    public function AddBanner(){
        return view('backend.banner.add_banner');
    }//End Method


    public function AddBannerStore(Request $request){
    

        $image= Storage::putFile("banner",$request['image']);
        Banner::create([
            "title"=>$request->title,
            "url"=>$request->url,
            "image"=>$image
        ]);

       $notification = [
        "message"=>"Banner Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('banner.all')->with($notification);


    }// End Method


    
    public function EditBanner($id){

        $banner =Banner::findOrFail($id);
        return view('backend.banner.edit_banner',compact("banner"));
    }//End Method

    public function BannerUpdate(Request $request ,$id){
     

        $banner= Banner::findOrFail($id);
        if($request->has("image")){
           Storage::delete($banner->image);
          $image=  Storage::putFile("banner",$request["image"]);
        }else{
            $image=$banner->image;
        }
        $banner->update([
            "title"=>$request->title,
            "url"=>$request->url,
            "image"=>$image
        ]);




   

       $notification = [
        "message"=>"Banner Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('banner.all')->with($notification);


    }//End Method 




    public function DeleteBanner($id){
        $banner= Banner::findOrFail($id);
        Storage::delete($banner->image);
       $banner->delete();


       $notification = [
        "message"=>"Banner Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('banner.all')->with($notification);
    }// End Method

}
