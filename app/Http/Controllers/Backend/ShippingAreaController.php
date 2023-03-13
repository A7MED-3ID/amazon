<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipDistricts;
use App\Models\ShipState;

class ShippingAreaController extends Controller
{
    //

    public function AllDivision(){

        $divisions = ShipDivision::latest()->get();

        return view('backend.ship.division.division_all',compact("divisions"));

    }//End Method

    public function AddDivision (){

        return view('backend.ship.division.add_division');

    }//End Method

    public function AddDivisionStore(Request $request){
    

        
        ShipDivision::create([
            "name"=>$request->name ,
            
            "created_at"=>Carbon::now()
           
        ]);

       $notification = [
        "message"=>"Division Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('all.division')->with($notification);


    }// End Method

    public function EditDivision($id){

        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.division.edit_division',compact('division'));

    }// End Method

    public function DivisionUpdate($id, Request $request){

       $division= ShipDivision::findOrFail($id);
 
        $division->update([
            "name"=>$request->name,
            "updated_at"=>Carbon::now()
        ]);

        $notification = [
            "message"=>"Division Updated  Successfully",
            "alert-type"=>"success"
          ];
    
         return redirect()->route('all.division')->with($notification);
    }// End Method

    public function DeleteDivision($id){
       $division= ShipDivision::findOrFail($id);

       $division->delete();

       
       $notification = [
        "message"=>"Division Deleted  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->route('all.division')->with($notification);

        

    }// End Method


    public function AllDistrict(){

        
        $districts = ShipDistricts::latest()->get();

        return view('backend.ship.district.district_all',compact("districts"));

    }// End Method


    public function AddDistrict (){

        $divisions = ShipDivision::orderBy('name',"ASC")->get();


        return view('backend.ship.district.add_district',compact("divisions"));

    }//End Method


    public function AdddDistrictStore(Request $request){
    

        
        ShipDistricts::create([
            "name"=>$request->name ,
            "division_id"=>$request->division_id,
            
            "created_at"=>Carbon::now()
           
        ]);

       $notification = [
        "message"=>"District Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('all.district')->with($notification);


    }// End Method

    
    public function EditDistrict($id){

        $district = ShipDistricts::findOrFail($id);
        $divisions = ShipDivision::orderBy('name',"ASC")->get();


        return view('backend.ship.district.edit_district',compact('district','divisions'));

    }// End Method

    public function DistrictUpdate($id, Request $request){

       $district= ShipDistricts::findOrFail($id);
 
        $district->update([
            "name"=>$request->name,
            "division_id"=>$request->division_id,
            "updated_at"=>Carbon::now()
        ]);

        $notification = [
            "message"=>"district Updated  Successfully",
            "alert-type"=>"success"
          ];
    
         return redirect()->route('all.district')->with($notification);
    }// End Method


    public function DeleteDistrict($id){
        $district= ShipDistricts::findOrFail($id);
 
        $district->delete();
 
        
        $notification = [
         "message"=>"District Deleted  Successfully",
         "alert-type"=>"success"
       ];
 
      return redirect()->route('all.district')->with($notification);
 
         
 
     }// End Method



     public function AllState(){

        $divisions = ShipDivision::orderBy('name',"ASC")->get();


        
        $districts = ShipDistricts::orderBy('name',"ASC")->get();

        $states= ShipState::latest()->get();

        return view('backend.ship.state.state_all',compact("divisions","districts","states"));

    }// End Method


    public function AddState (){

        $divisions = ShipDivision::orderBy('name',"ASC")->get();
        $districts = ShipDistricts::orderBy('name',"ASC")->get();



        return view('backend.ship.state.add_state',compact("divisions","districts"));

    }//End Method


    public function AdddStateStore(Request $request){
    

        
        ShipState::create([
            "name"=>$request->name ,
            "division_id"=>$request->division_id,
            "district_id"=>$request->district_id,

            
            "created_at"=>Carbon::now()
           
        ]);

       $notification = [
        "message"=>"State Added  Successfully",
            "alert-type"=>"success"
        ];

        return redirect()->route('all.state')->with($notification);


    }// End Method


    public function LoadDistrict($division_id){
        $districts = ShipDistricts::where("division_id",$division_id)->orderBy("name","ASC")->get();
        return json_encode($districts);

    }// End Method


    
    public function EditState($id){

        $state = ShipState::findOrFail($id);
        $divisions = ShipDivision::orderBy('name',"ASC")->get();
        $districts = ShipDistricts::orderBy('name',"ASC")->get();



        return view('backend.ship.state.edit_state',compact('state','districts','divisions'));

    }// End Method

    public function StateUpdate($id, Request $request){

       $state= ShipState::findOrFail($id);
 
        $state->update([
            "name"=>$request->name,
            "division_id"=>$request->division_id,
            "district_id"=>$request->district_id,

            "updated_at"=>Carbon::now()
        ]);

        $notification = [
            "message"=>"State Updated  Successfully",
            "alert-type"=>"success"
          ];
    
         return redirect()->route('all.state')->with($notification);
    }// End Method


    public function DeleteState($id){
        $state= ShipState::findOrFail($id);
 
        $state->delete();
 
        
        $notification = [
         "message"=>"State Deleted  Successfully",
         "alert-type"=>"success"
       ];
 
      return redirect()->route('all.state')->with($notification);
 
         
 
     }// End Method






    


}
