<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    ////////////// All Permission Methods //////////////////////

    public function AllPermission(){

        $permissions = Permission::all();

        return view('backend.pages.permission.all_permission',compact('permissions'));


    }//End Method

    public function AddPermission(){

        return view('backend.pages.permission.add_permission');

    }//End Method

    public function StorePermission(Request $request){
        
        
      $permission = Permission::create([
        'name' => $request->name,
        'group_name'=>$request->group_name

    ]);

      $notification = [
        "message"=>"Permission Added Successfully",
        "alert-type"=>"success"
      ];


      
      return redirect()->route('all.permission')->with($notification);

    }//End Method


    public function EditPermission($id){

       $permission= Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission',compact('permission'));

    }//End Method

    public function UpdatePermission($id, Request $request){

        Permission::findOrFail($id)->update([
            'name' => $request->name,
            'group_name'=>$request->group_name
    
        ]);

        $notification = [
            "message"=>"Permission Updated Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->route('all.permission')->with($notification);
    



    } //End Method


    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        
        $notification = [
            "message"=>"Permission Deleted Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->back()->with($notification);
    

    }//End Method



    ////////////// All Roles Methods //////////////////////
    

    public function AllRole(){

        $roles = Role::all();

        return view('backend.pages.roles.all_roles',compact('roles'));


    }//End Method

    public function AddRole(){

        return view('backend.pages.roles.add_roles');

    }//End Method

    public function StoreRole(Request $request){
        
        
      $role = Role::create([
        'name' => $request->name,

    ]);

      $notification = [
        "message"=>"Role Added Successfully",
        "alert-type"=>"success"
      ];


      
      return redirect()->route('all.role')->with($notification);

    }//End Method


    public function Editrole($id){

       $role= Role::findOrFail($id);

        return view('backend.pages.roles.edit_roles',compact('role'));

    }//End Method

    public function Updaterole($id, Request $request){

        Role::findOrFail($id)->update([
            'name' => $request->name,
    
        ]);

        $notification = [
            "message"=>"Role Updated Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->route('all.role')->with($notification);
    



    } //End Method


    public function Deleterole($id){

        Role::findOrFail($id)->delete();

        
        $notification = [
            "message"=>"Role Deleted Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->back()->with($notification);
    

    }//End Method



    ////////////// All Roles In Permission Methods //////////////////////


    public function AddRolePermission(){

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('backend.pages.roles.add_roles_permission',compact('roles','permissions','permission_groups'));

    }//End Method

    public function RolePermissionStore(Request $request){

        $data = [];

        $permissions = $request->permission;

        foreach ($permissions as $key=>$item){
            $data['role_id']=$request->role_id;

            $data["permission_id"]=$item;

            DB::table('role_has_permissions')->insert($data);
        
        }



        $notification = [
            "message"=>"Role Permission Added Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->route('all.role')->with($notification);



    }//End Method

    public function AllRolesPermission(){

        $roles=Role::all();

        return view('backend.pages.roles.all_roles_permission',compact('roles'));

    }//End Method


    public function AdminEditRoles($id){

        $role = Role::findOrFail($id);

        $permission_groups = User::getpermissionGroups();


        return view('backend.pages.roles.role_permission_edit',compact('role','permission_groups'));

    }//End Method

    public function AdminRolesUpdate($id, Request $request){

        $role = Role::findOrFail($id);


        

        $permissions = $request->permission;

        if(! empty($permissions)){
            $role->syncPermissions($permissions);
        }

     



        $notification = [
            "message"=>"Role Permission Updated Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->route('all.roles.permission')->with($notification);





    }//End Method


    public function AdminDeleteRoles($id){

        $role = Role::findOrFail($id);

        if(! is_null($role)){

            $role->delete();


        }


        $notification = [
            "message"=>"Role Permission Deleted Successfully",
            "alert-type"=>"success"
          ];
    
          return redirect()->back()->with($notification);


    }//End Method

}
