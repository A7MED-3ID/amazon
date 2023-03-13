<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //

    public function PendingOrder(){

        $orders = Order::where("status","pending")->orderBy("id","DESC")->get();

        return view("backend.order.order_pending",compact('orders'));

    }//End Method


    public function OrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();

        $orderItem = OrderItem::with("product")->where("order_id",$order_id)->orderBy("id","DESC")->get();

        return view('backend.order.admin_order_details',compact('order',"orderItem"));


    }//End Method

    public function ConfirmedOrder(){

        $orders = Order::where('status',"confirmed")->orderBy("id","DESC")->get();


        return view('backend.order.confirmed_orders',compact('orders'));

    }//End Method

    
    public function ProcessingOrder(){

        $orders = Order::where('status',"processing")->orderBy("id","DESC")->get();


        return view('backend.order.processing_orders',compact('orders'));

    }//End Method



    
    public function DeliveredOrder(){

        $orders = Order::where('status',"delivered")->orderBy("id","DESC")->get();


        return view('backend.order.delivered_orders',compact('orders'));

    }//End Method

    public function PendingToConfirm($order_id){

         Order::findOrFail($order_id)->update(["status"=>"confirmed"]);

        

        $notification = [
            "message"=>"Order Confirmed Successfully",
            "alert-type"=>"success"
        ];


        return redirect()->route('admin.confirmed.order')->with($notification);


    }//End Method


    
    public function ConfirmToProcessing($order_id){

        Order::findOrFail($order_id)->update(["status"=>"processing"]);

       

       $notification = [
           "message"=>"Order Processing Successfully",
           "alert-type"=>"success"
       ];


       return redirect()->route('admin.processing.order')->with($notification);


   }//End Method

   
    
   public function ProcessingToDelivered($order_id){

    $product = OrderItem::where("order_id",$order_id)->get();

    foreach($product as $item){
        Product::where("id",$item->product_id)->update([
            "quantity"=>DB::raw("quantity-".$item->quantity),
        ]);
    }


    Order::findOrFail($order_id)->update(["status"=>"delivered"]);

   

   $notification = [
       "message"=>"Order Delivered Successfully",
       "alert-type"=>"success"
   ];


   return redirect()->route('admin.delivered.order')->with($notification);


}//End Method

public function AdminInvoiceDownload($order_id){
    $order = Order::with('division','district','state','user')->where('id',$order_id)->first();

    $orderItem = OrderItem::with("product")->where("order_id",$order_id)->orderBy("id","DESC")->get();

    $pdf = Pdf::loadView('backend.order.admin_order_invoice',compact('order','orderItem'))->setPaper('a4')->setOption([
        'tempDir'=>public_path(),
        'chroot'=> public_path()
    ]);
    return $pdf->download('invoice.pdf');

}//End Method



}
