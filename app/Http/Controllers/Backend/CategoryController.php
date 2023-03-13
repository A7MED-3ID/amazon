<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //

    public function AllCategories(){
        
        $categories = Category::all()->sortByDesc("id");
        return view('backend.category.category_all',compact("categories"));

    }//End Method

    public function AddCategory(){
        return view('backend.category.category_add');
    }//End Method


    public function AddCategoryStore(Request $request){
    

        $image= Storage::putFile("category",$request['image']);
        Category::create([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
            "image"=>$image
        ]);

       $notification = [
        "message"=>"Category Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('category.all')->with($notification);


    }// End Method



    public function EditCategory($id){

        $category =Category::findOrFail($id);
        return view('backend.category.category_edit',compact("category"));
    }//End Method



    public function CategoryUpdate(Request $request ,$id){
     

        $category= Category::findOrFail($id);
        if($request->has("image")){
           Storage::delete($category->image);
          $image=  Storage::putFile("category",$request["image"]);
        }else{
            $image=$category->image;
        }
        $category->update([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
            "image"=>$image
        ]);




   

       $notification = [
        "message"=>"Category Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('category.all')->with($notification);


    }//End Method 



    public function DeleteCategory($id){
        $category= Category::findOrFail($id);
        Storage::delete($category->image);
       $category->delete();


       $notification = [
        "message"=>"Category Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('category.all')->with($notification);
    }// End Method
}
