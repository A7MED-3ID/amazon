<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    //

    public function AllSubCategories(){
        
        $subcategories = SubCategory::all()->sortByDesc("id");
        return view('backend.subcategory.subcategory_all',compact("subcategories"));

    }//End Method


    public function AddSubCategory(){
        $categories = Category::all()->sortByDesc("id");

        return view('backend.subcategory.subcategory_add',compact("categories"));
    }//End Method



    public function AddSubCategoryStore(Request $request){
    

        
        SubCategory::create([
            "name"=>$request->name,
            "category_id"=>$request->category_id,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
           
        ]);

       $notification = [
        "message"=>"SubCategory Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('subcategory.all')->with($notification);


    }// End Method




    public function EditSubCategory($id){
        $categories = Category::all()->sortByDesc("id");
        
        $subcategory =SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit',compact("subcategory","categories"));
    }//End Method




    public function SubCategoryUpdate(Request $request ,$id){
     

        $subcategory= SubCategory::findOrFail($id);
     
        $subcategory->update([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
            "category_id"=>$request->category_id,
        ]);




   

       $notification = [
        "message"=>"SubCategory Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('subcategory.all')->with($notification);


    }//End Method 



    public function DeleteSubCategory($id){
        $subcategory= SubCategory::findOrFail($id);
        
       $subcategory->delete();


       $notification = [
        "message"=>"SubCategory Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('subcategory.all')->with($notification);
    }// End Method


    public function GetSubCategory($category_id){
        $subcat = SubCategory::where("category_id",$category_id)->orderBy("name","ASC")->get();
        return json_encode($subcat);
    } //End Method

    
}
