<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\VendorApproveNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.index');
        // echo "hello";
    }// End Method

    public function logout(Request $request){

        
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } //End Method

    public function AdminLogin(){
        return view('admin.admin_login');
    } //End Method


    public function AdminProfile(){
        $id = Auth::user()->id;
        $admin= User::findOrFail($id);
        
        return view('admin.admin_profile',compact("admin"));

        // print_r($user);

    }//End Method

    public function AdminProfileUpdate(Request $request){
        $id = Auth::user()->id;

        
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        
        // $data = $request;
        // dd($data);

       if($request->has("photo")){
        Storage::delete($data->photo);

       $data["photo"]=  Storage::putFile("admin",$request->photo);
        }

      //   $admin->update($data);
       
          $data->save();
        // session()->flash("update","data updated successfuly");


        $notification = [
            "message"=>"Admin Profile Updated Successfully",
            "alert-type"=>"success"
        ];


      return redirect()->back()->with($notification);


    }//End Method

    public function AdminChangePassword(){

        $id = Auth::user()->id;

        
        $admin = User::findOrFail($id);

        return view('admin.admin_change_password',compact("admin"));
        
    }  // End Method


    public function AdminUpdatePassword(Request $request){
    

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
      
    }// End Method



    public function InactiveVendor(){

       $inactive_vendors = User::where("role","vendor")->where("status","inactive")->get();

       return view('backend.vendor.inactive_vendor',compact("inactive_vendors"));

    }// End Method


    public function ActiveVendor(){



        $active_vendors = User::where("role","vendor")->where("status","active")->get();

 
        return view('backend.vendor.active_vendor',compact("active_vendors"));
 
     }// End Method

     public function InactiveVendorDetails($id){
        $inactive_vendor = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact("inactive_vendor"));

     }//End Method

     public function InactiveVendorApprove($id, Request $request){
       $user = User::findOrFail($id);
       $user->update([
            "status"=>"active"
        ]);


        $notification = [
            "message"=>"Vendor Actived  Successfully",
            "alert-type"=>"success"
        ];

        Notification::send($user, new VendorApproveNotification($request));


      return redirect("active/vendor")->with($notification);





    }//End Method

     public function ActiveVendorDetails($id){

        $active_vendor = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact("active_vendor"));

     }//End Method


     public function ActiveVendorDisApprove($id){

        User::findOrFail($id)->update([
            "status"=>"inactive"
        ]);


        $notification = [
            "message"=>"Vendor deactivated  Successfully",
            "alert-type"=>"success"
        ];


      return redirect("inactive/vendor")->with($notification);

     }//End Method


    /////////////// All Admin User Methods /////////////

    public function AllAdmin(){

        $alladminuser = User::where('role','admin')->latest()->get();


        return view('backend.admin.all_admin',compact('alladminuser'));

    }//End Method


    public function AddAdmin(){

        $roles = Role::all();

        return view('backend.admin.add_admin',compact('roles'));

    }//End Method

    public function AdminUserStore(Request $request){

      $user = new User();
             $user->user_name=$request->user_name;
             $user->name=$request->name;
             $user->email=$request->email;
             $user->phone=$request->phone;
             $user->address=$request->address;
             $user->password=Hash::make( $request->password);
             $user->role="admin";
             $user->status="active";

             $user->save();



        if($request->roles){
            $user->assignRole($request->roles);
        }


        $notification = [
            "message"=>"Admin Added Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('all.admin')->with($notification);

    }//End Method

    public function EditAdminRole($id){

       $user= User::findOrFail($id);

       $roles = Role::all();


        return view('backend.admin.edit_admin',compact('user','roles'));

    }//End Method


    public function AdminUserUpdate($id,Request $request){




       $user= User::findOrFail($id);

       $user->user_name=$request->user_name;
       $user->name=$request->name;
       $user->email=$request->email;
       $user->phone=$request->phone;
       $user->address=$request->address;
       $user->password=Hash::make( $request->password);
       $user->role="admin";
       $user->status="active";

       $user->save();

       $user->roles()->detach();

       if($request->roles){
        $user->assignRole($request->roles);
    }



        $notification = [
            "message"=>"Admin User Updated Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('all.admin')->with($notification);



    }//End Method

    public function DeleteAdminRole($id){

        $user = User::findOrFail($id);

        if(! is_null($user)){
            $user->delete();
        }


        $notification = [
            "message"=>"Admin Deleted Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->back()->with($notification);



    }//End Method
}
