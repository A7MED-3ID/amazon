<?php

namespace App\Http\Controllers\Backend;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    //

    public function SiteSetting(){
        $setting = SiteSetting::find(1);

        return view('backend.setting.setting_update',compact('setting'));

    }//End Method

    public function SiteSettingUpdate($id ,Request $request){

        

        $setting= SiteSetting::findOrFail($id);
        if($request->has("logo")){
           Storage::delete($setting->logo);
          $logo=  Storage::putFile("setting",$request["logo"]);
        }else{
            $logo=$setting->logo;
        }
        $setting->update([
            "support_phone"=>$request->support_phone,
            "phone_one"=>$request->phone_one,
            "email"=>$request->email,
            "company_address"=>$request->company_address,
            "facebook"=>$request->facebook,
            "twitter"=>$request->twitter,
            "youtube"=>$request->youtube,
            "copyright"=>$request->copyright,
            "logo"=>$logo,
            "updated_at"=>Carbon::now()
        ]);




   

       $notification = [
        "message"=>"Site Setting Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->back()->with($notification);

    }//End Method

    public function SeoSetting(){

        $seo = Seo::find(1);


        return view('backend.seo.seo_update',compact('seo'));

    }//End Method

    public function SeoSettingUpdate($id,Request $request){
       
        $seo = Seo::findOrFail($id);
        $seo->update([
            "meta_title"=>$request->meta_title,
            "meta_author"=>$request->meta_author,
            "meta_keyword"=>$request->meta_keyword,
            "meta_description"=>$request->meta_description,
            
            "updated_at"=>Carbon::now()
        ]);

        
       $notification = [
        "message"=>"Seo Updated  Successfully",
        "alert-type"=>"success"
      ];

     return redirect()->back()->with($notification);

    }//End Method
}
