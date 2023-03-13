<?php

namespace App\Http\Controllers\Backend;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    ////////////////////// Blog Category All Methods  ///////////
    

    public function AdminBlogCategory(){

        $blogCategories = BlogCategory::latest()->get();

        return view('backend.blog.category.blogcategroy_all',compact('blogCategories'));

    }//End Method

    public function AddBlogCategory(){

        return view('backend.blog.category.blogcategroy_add');

    }//End Method


    public function StoreBlogCategory(Request $request){

        BlogCategory::create([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
           
        ]);

       $notification = [
        "message"=>"Blog Category Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('admin.blog.category')->with($notification);


    }//End Method


    public function EditBlogCategory($id){
        // $blogCategories = BlogCategory::all()->sortByDesc("id");
        
        $blogCategory =BlogCategory::findOrFail($id);
        return view('backend.blog.category.blogcategroy_edit',compact("blogCategory"));
    }//End Method



    public function UpdateBlogCategory(Request $request ,$id){
     

        $blogCategory= BlogCategory::findOrFail($id);
     
        $blogCategory->update([
            "name"=>$request->name,
            "slug"=>strtolower(str_replace(" ","-",$request->name)),
        ]);




   

       $notification = [
        "message"=>"Blog Category Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('admin.blog.category')->with($notification);



    }//End Method



    public function DeleteBlogCategory($id){
        $blogCategory= BlogCategory::findOrFail($id);
        
       $blogCategory->delete();


       $notification = [
        "message"=>"Blog Category Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('admin.blog.category')->with($notification);
    }// End Method




    ////////////////////// Blog Post All Methods  ///////////



    public function AdminBlogPost(){

        $blogPosts = BlogPost::latest()->get();

        return view('backend.blog.post.blogpost_all',compact('blogPosts'));

    }//End Method


    public function AddBlogPost(){

        $blogCategories = BlogCategory::latest()->get();


        return view('backend.blog.post.blogpost_add',compact('blogCategories'));

    }//End Method


    
    public function StoreBlogPost(Request $request){
    

        $image= Storage::putFile("blogpost",$request['post_image']);
        BlogPost::create([
            "category_id"=>$request->category_id,
            "post_title"=>$request->post_title,
            "post_short_desc"=>$request->post_short_desc,
            "post_long_desc"=>$request->post_long_desc,
            "post_slug"=>strtolower(str_replace(" ","-",$request->post_title)),


            "post_image"=>$image
        ]);

       $notification = [
        "message"=>"Blog Post Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('admin.blog.post')->with($notification);


    }// End Method


    public function EditBlogPost($id){
        $blogCategories = BlogCategory::latest()->get();


        $blogpost =BlogPost::findOrFail($id);
        return view('backend.blog.post.blogpost_edit',compact("blogpost","blogCategories"));
    }//End Method



    public function UpdateBlogPost(Request $request ,$id){
     

        $blogpost= BlogPost::findOrFail($id);
        if($request->has("post_image")){
           Storage::delete($blogpost->post_image);
          $image=  Storage::putFile("blogpost",$request["post_image"]);
        }else{
            $image=$blogpost->post_image;
        }
        $blogpost->update([
            "category_id"=>$request->category_id,
            "post_title"=>$request->post_title,
            "post_short_desc"=>$request->post_short_desc,
            "post_long_desc"=>$request->post_long_desc,
            "post_slug"=>strtolower(str_replace(" ","-",$request->post_title)),

            "post_image"=>$image
        ]);




   

       $notification = [
        "message"=>"Blog Post Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('admin.blog.post')->with($notification);


    }//End Method



    public function DeleteBlogPost($id){
        $blogpost= BlogPost::findOrFail($id);
        Storage::delete($blogpost->post_image);
       $blogpost->delete();


       $notification = [
        "message"=>"Blog Post Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('admin.blog.post')->with($notification);
    }// End Method




    ////////////////////// Front End All Methods  ///////////
    public function AllBlog(){

        $blogpost = BlogPost::latest()->get();
        $blogCategories = BlogCategory::latest()->get();


        return view('frontend.blog.home_blog',compact("blogpost","blogCategories"));

    }//End Method


    public function PostDetails($id,$slug){

       $blogdetails= BlogPost::findOrFail($id);

       $blogCategories = BlogCategory::latest()->get();
       $breadcat =BlogCategory::where("id",$id)->get();

       return view('frontend.blog.blog_details',compact("blogdetails","blogCategories","breadcat"));

    }//End Method

    public function CategoryPosts($id,$slug){

       $breadcat =BlogCategory::where("id",$id)->get();
       $blogCategories = BlogCategory::latest()->get();

       $blogpost = BlogPost::where("category_id",$id)->get();

       return view('frontend.blog.category_post',compact("breadcat","blogCategories","blogpost"));


    }//End Method
}
