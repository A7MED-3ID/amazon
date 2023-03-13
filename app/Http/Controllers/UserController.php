<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index(Request $request){
        
        $id = Auth::user()->id;
        $userData = User::findOrFail($id);
      
        return view('index',compact("userData"));

    }//End Method


    public function logout(Request $request){

        
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            "message"=>"User Logged Out Successfully",
            "alert-type"=>"success"
        ];

        return redirect('/login')->with($notification);
    } //End Method



    

    public function UserProfileUpdate(Request $request){

        $id = Auth::user()->id;

        
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->user_name = $request->user_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        
    

       if($request->has("photo")){
        Storage::delete($data->photo);

         $data["photo"]=  Storage::putFile("user",$request->photo);
        }

      
       
          $data->save();


        $notification = [
            "message"=>"User Profile Updated Successfully",
            "alert-type"=>"success"
        ];


      return redirect()->back()->with($notification);



    } // End Method

    public function UserUpdatePassword(Request $request){

        

        $data =$request->validate([
            "old_password"=>"required",
            "new_password"=>"required|confirmed"
        ]);

      if(!( Hash::check($data["old_password"],auth::user()->password))){
          
       
         
           return back()->with("error","Old Password Doesn't match!");


      }

       #Update the new Password
       User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->new_password)
         ]);
         
         return back()->with("status","Password changed successfully!");

    }
}
