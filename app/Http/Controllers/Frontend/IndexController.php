<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //

    public function Index(){
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0= Product::where("status","active")->where("category_id",$skip_category_0->id)->orderBy("id","DESC")->limit(5)->get(); 

        
        $skip_category_2 = Category::skip(2)->first();
        $skip_product_2= Product::where("status","active")->where("category_id",$skip_category_2->id)->orderBy("id","DESC")->limit(5)->get(); 

        
        $skip_category_7 = Category::skip(7)->first();
        $skip_product_7= Product::where("status","active")->where("category_id",$skip_category_7->id)->orderBy("id","DESC")->limit(5)->get(); 


        $hot_deals = Product::where("status","active")->where("hot_deals",1)->where("discount_price","!=",null)->orderBy("id","DESC")->limit(3)->get();
        
        $special_offer = Product::where("status","active")->where("special_offer",1)->orderBy("id","DESC")->limit(3)->get();

        $special_deals = Product::where("status","active")->where("special_deals",1)->orderBy("id","DESC")->limit(3)->get();

        $new = Product::where("status","active")->orderBy("id","DESC")->limit(3)->get();

        return view('frontend.index',compact("skip_category_0","skip_product_0","skip_category_2","skip_product_2","skip_category_7","skip_product_7","hot_deals","special_offer","special_deals","new"));

    }//End Method  

    public function ProductDetails($id,$slug){
        $product = Product::findOrFail($id);
        $colors =explode(",",$product->color);
        $sizes =explode(",",$product->size);

        $multiImg = MultiImage::where("product_id",$id)->get();
        $relatedProducts = Product::where("category_id",$product->category_id)->where("id","!=",$id)->orderBy("id","DESC")->limit(4)->get();


        return view('frontend.product.product_detail',compact("product","colors","sizes","multiImg","relatedProducts"));


    }//End Method

    public function VendorDetails($id){

        $vendor = User::findOrFail($id);
        $vendor_products = Product::where("vendor_id",$id)->get();

        return view('frontend.vendor.vendor_details',compact("vendor","vendor_products"));

    }//End Method

    public function AllVendors(){

        $vendors = User::where("status","active")->where("role","vendor")->orderBy("id","DESC")->get();
        


        return view("frontend.vendor.vendor_all",compact("vendors"));

    }//End Method


    public function CategoryProducts($id){
        $products = Product::where("status","active")->where("category_id",$id)->orderBy("id","DESC")->get();

        $categories = Category::orderBy("name","ASC")->limit(5)->get();

        $current_cat =Category::where("id",$id)->first();
        $new_products = Product::orderBy("id","DESC")->limit(3)->get();


        return view('frontend.product.category_view',compact("products","categories","current_cat","new_products"));

    }//End Method


    public function SubCategoryProducts($id){

        $products = Product::where("status","active")->where("subcategory_id",$id)->orderBy("id","DESC")->get();

        $subcategories = SubCategory::orderBy("name","ASC")->limit(5)->get();

        $current_subcat =SubCategory::where("id",$id)->first();
        $new_products = Product::orderBy("id","DESC")->limit(3)->get();


        return view('frontend.product.subcategory_view',compact("products","subcategories","current_subcat","new_products"));



        

    }//End Method



    public function ProductViewAjax($id){

        $product = Product::with('brand','category')->findOrFail($id);
        
        $colors =explode(",",$product->color);
        $sizes =explode(",",$product->size);

        return response()->json([
            "product"=>$product,
            "color"=>$colors,
            "size"=>$sizes
        ]);

    }//End Method

    public function ProductSearch(Request $request){

        $request->validate(["search"=>"required"]);
        $item = $request->search;

        $categories = Category::orderBy("name","ASC")->limit(5)->get();
        $new_products = Product::orderBy("id","DESC")->limit(3)->get();



       $products=  Product::where("name","LIKE","%$item%")->get();

        return view('frontend.product.search',compact('products','item',"categories","new_products"));

    }//End Method


    public function SearchProduct(Request $request){

        $request->validate(["search"=>"required"]);
        $item = $request->search;


        $products=  Product::where("name","LIKE","%$item%")->select('name','slug','product_thambnail','selling_price','id')->limit(6)->get();

        return view('frontend.product.search_product',compact('products'));





    }//End Method
    

}
