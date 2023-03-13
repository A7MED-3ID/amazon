<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VendorRegNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;


use Spatie\FlareClient\View;

class VendorController extends Controller
{
    //
    public function dashboard(){
        return view('vendor.index');
    } // End Method


    public function logout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');

    }

    public function VendorLogin(){
        return view('vendor.vendor_login');

    } //End Method

    public function VendorProfile(){
        $id = Auth::user()->id;
        $vendor= User::findOrFail($id);
        
        return view('vendor.vendor_profile',compact("vendor"));
    }// End Method

    public function VendorProfileUpdate(Request $request){

        $id = Auth::user()->id;

        
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;


        
        // $data = $request;
        // dd($data);

       if($request->has("photo")){
        Storage::delete($data->photo);

         $data["photo"]=  Storage::putFile("vendor",$request->photo);
        }

      //   $admin->update($data);
       
          $data->save();
        // session()->flash("update","data updated successfuly");


        $notification = [
            "message"=>"Vendor Profile Updated Successfully",
            "alert-type"=>"success"
        ];


      return redirect()->back()->with($notification);


    }// End Method



    public function VendorChangePassword(){

        $id = Auth::user()->id;

        
        $vendor = User::findOrFail($id);

        return view('vendor.vendor_change_password',compact("vendor"));

    }// End Method

    public function VendorUpdatePassword(Request $request){

        $data =$request->validate([
            "old_password"=>"required",
            "new_password"=>"required|confirmed"
        ]);

      if(!( Hash::check($data["old_password"],auth::user()->password))){
          
        //   session()->flash("error","Old Password Doesn't match!");
       
         
           return back()->with("error","Old Password Doesn't match!");


      }

       #Update the new Password
       User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->new_password)
         ]);
        //  session()->flash("update","Password changed successfully!");
         
         return back()->with("status","Password changed successfully!");

    } // End Method


    public function BecomeVendor(){

        return View('auth.become_vendor');

    }// End Method



    public function VendorRegister(Request $request){

        $user = User::where("role","admin")->get();

      $data=  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email"],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'vendor_join' => ['required'],
            'password' => ['required', 'confirmed'],
            
        ]);

        $data["password"]=bcrypt($data["password"]);
        $data["role"]="vendor";
        $data["status"]="inactive";


          User::create($data);

        $notification = [
            "message"=>"Vendor Registerd Successfully",
            "alert-type"=>"success"
        ];

  Notification::send($user, new VendorRegNotification($request));



      return redirect()->route('vendor.login')->with($notification);


    }// End Method
}
