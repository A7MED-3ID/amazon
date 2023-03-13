<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VendorProductController extends Controller
{
    //

    public function AllProduct(){
        $id=Auth::user()->id;
        $products = Product::where("vendor_id",$id)->latest()->get();
        return view('vendor.product.all_product',compact("products","id"));
    }//End Method


    public function AddProduct(){

        $brands = Brand::all()->sortByDesc("id");
        $categories = Category::all()->sortByDesc("id");
        return view('vendor.product.add_product',compact("brands","categories"));
    } //End Method

    
    public function VendorGetSubCategory($category_id){
        $subcat = SubCategory::where("category_id",$category_id)->orderBy("name","ASC")->get();
        return json_encode($subcat);
    }  //End Method


    public function StoreProduct(Request $request){

        $image= Storage::putFile("product/thambnail",$request['product_thambnail']);

         
         $product_id= Product::insertGetId([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
            "product_thambnail"=>$image,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'size' => $request->size,
            'color' => $request->color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc, 



            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            
            'vendor_id'=>Auth::user()->id,
           
            'status' =>"active",

        ]);



        //////// multi images ////////

       $images = $request->multi_img;
        foreach($images as $img){
            $image= Storage::putFile("product/multi-imgs",$img);
         

            MultiImage::insert([

                'product_id' => $product_id,
                'photo_name' => $image,
                
    
            ]); 

        
        } /// End Foreach

       
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.product.all')->with($notification); 
       

    } //End Method


   
    public function VendorEditProduct($id){

       
        $multi_imgs=MultiImage::where("product_id","$id")->get();

        $brands = Brand::all()->sortByDesc("id");
        $categories = Category::all()->sortByDesc("id");
        $subcategories = SubCategory::all()->sortByDesc("id");
        $product = Product::findOrFail($id);
        return view('vendor.product.edit_product',compact("brands","categories","product","subcategories","multi_imgs"));

    }//End Method

    public function UpdateProduct($id,Request $request){

        Product::findOrFail($id)->update([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
         
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'code' => $request->code,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'size' => $request->size,
            'color' => $request->color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc, 



            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            
            'vendor_id'=>Auth::user()->id,

            'status' =>"active",

        ]);




        
        $notification = array(
            'message' => 'Product Updated Without Images Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.product.all')->with($notification); 

    }//End Method

    

    public function UpdateProductThambnail($id,Request $request){

        $product= Product::findOrFail($id);
 
         
         if($request->has("product_thambnail")){
            Storage::delete($product->product_thambnail);
           $image=  Storage::putFile("product",$request["product_thambnail"]);
         }else{
             $image=$product->product_thambnail;
         }
         $product->update([
             "product_thambnail"=>$image
         ]);
 
 
         $notification = array(
             'message' => 'Product Thambnail Image Updated  Successfully',
             'alert-type' => 'success'
         );
 
         return redirect()->route('vendor.product.all')->with($notification); 
 
 
 
         
 
    }// End Method

    
    public function UpdateProductMultiImg(Request $request, $id){
    
        $imgs= $request->multi_img;
        foreach($imgs as $id=>$img){
          $imgDel = MultiImage::findOrFail($id);
          // unlink($imgDel->photo_name);
          Storage::delete($imgDel->photo_name);
  
          $image= Storage::putFile("product/multi-imgs",$img);
  
          MultiImage::where("id",$id)->update([
              'photo_name'=>$image
          ]);
          
  
  
  
        }// End Foreach
  
  
        $notification = array(
          'message' => 'Product Multi Image Updated Successfully',
          'alert-type' => 'success'
       );
  
       return redirect()->back()->with($notification); 
  
  
     
           
  
  
  
      
     
  
    }//End Mehod
  
  
      public function DeleteImage($id){
         $img= MultiImage::findOrFail($id);
         Storage::delete($img->photo_name);
         
         $img->delete();
         
        $notification = array(
          'message' => ' Image Deleted Successfully',
          'alert-type' => 'success'
       );
  
       return redirect()->back()->with($notification); 
  
  
  
  
    }//End Method



    public function DeleteProduct($id){
        $product= Product::findOrFail($id);
        Storage::delete($product->product_thambnail);
       $imgs= MultiImage::where("product_id",$product->id)->get();
       foreach($imgs as $img){
        Storage::delete($img->photo_name);
        MultiImage::where("product_id",$product->id)->delete();

       }
       $product->delete();

       $notification = array(
        'message' => 'Product Deleted  Successfully',
        'alert-type' => 'success'
       );
     return redirect()->back()->with($notification); 


    } //End Mehod



    public function ActiveProduct($id){
       Product::findOrFail($id)->update(["status"=>"active"]);
       $notification = array(
        'message' => 'Product Actived  Successfully',
        'alert-type' => 'success'
     );

      return redirect()->route('vendor.product.all')->with($notification); 

        

    }// End Method

    public function InActiveProduct($id){
        Product::findOrFail($id)->update(["status"=>"inactive"]);
        $notification = array(
         'message' => 'Product Deactived  Successfully',
         'alert-type' => 'success'
        );
 
       return redirect()->route('vendor.product.all')->with($notification); 
 
 
    }// End Method




}
