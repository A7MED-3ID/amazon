<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //

    public function AllSliders(){
        
        $sliders = Slider::latest()->get();
        return view('backend.slider.all_slider',compact("sliders"));

    }//End Method

    public function AddSlider(){
        return view('backend.slider.add_slider');
    }//End Method


    public function AddSliderStore(Request $request){
    

        $image= Storage::putFile("slider",$request['image']);
        Slider::create([
            "title"=>$request->title,
            "short_title"=>$request->short_title,
            "image"=>$image
        ]);

       $notification = [
        "message"=>"Slider Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('slider.all')->with($notification);


    }// End Method


    
    public function EditSlider($id){

        $slider =Slider::findOrFail($id);
        return view('backend.slider.edit_slider',compact("slider"));
    }//End Method

    public function SliderUpdate(Request $request ,$id){
     

        $slider= Slider::findOrFail($id);
        if($request->has("image")){
           Storage::delete($slider->image);
          $image=  Storage::putFile("slider",$request["image"]);
        }else{
            $image=$slider->image;
        }
        $slider->update([
            "title"=>$request->title,
            "short_title"=>$request->short_title,
            "image"=>$image
        ]);




   

       $notification = [
        "message"=>"Slider Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('slider.all')->with($notification);


    }//End Method 




    public function DeleteSlider($id){
        $slider= Slider::findOrFail($id);
        Storage::delete($slider->image);
       $slider->delete();


       $notification = [
        "message"=>"Slider Deleted  Successfully",
        "alert-type"=>"success"
     ];

     return redirect()->route('slider.all')->with($notification);
    }// End Method

}
