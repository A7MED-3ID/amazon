<?php

namespace App\Http\Controllers\Backend;

// require 'vendor/autoload.php';

use App\Models\Brand;
use Illuminate\Http\Request;
// use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;

class BrandController extends Controller
{
    //

    public function AllBrands(){
        
        $brands = Brand::all()->sortByDesc("id");
        return view('backend.brand.all_brands',compact("brands"));

    }//End Method

    public function AddBrand(){
        return view('backend.brand.add_brand');
    }//End Method

    public function AddBrandStore(Request $request){
    

        $image= Storage::putFile("brand",$request['image']);
        Brand::create([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
            "image"=>$image
        ]);

       $notification = [
        "message"=>"Brand Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('all.brand')->with($notification);


    }// End Method

    public function EditBrand($id){

        $brand =Brand::findOrFail($id);
        return view('backend.brand.edit_brand',compact("brand"));
    }//End Method

    public function BrandUpdate(Request $request ,$id){
     

        $brand= Brand::findOrFail($id);
        if($request->has("image")){
           Storage::delete($brand->image);
          $image=  Storage::putFile("brand",$request["image"]);
        }else{
            $image=$brand->image;
        }
        $brand->update([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
            "image"=>$image
        ]);




   

       $notification = [
        "message"=>"Brand Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('all.brand')->with($notification);


    }//End Method  

    public function DeleteBrand($id){
        $brand= Brand::findOrFail($id);
        Storage::delete($brand->image);
       $brand->delete();


       $notification = [
        "message"=>"Brand Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('all.brand')->with($notification);
    }// End Method
}
