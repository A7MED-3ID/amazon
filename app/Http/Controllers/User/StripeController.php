<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Mail\OrderMail;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Http\Controllers\Controller;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;

// use Stripe\Stripe;

class StripeController extends Controller
{
    //

    public function StripeOrder(Request $request){

      $user = User::where('role',"admin")->get();
        

      // Stripe::setApiKey('sk_test_51MfMkoJ2N9DPH3m9vKvtiwUyxXbpsZo4NORmgqc6PDoFCNyFFHTrv2i1Gl5YnsEZ0hTXjuXrmOWfL4CIbks0TbEz00jCtZvQRC');
      // Stripe\Stripe::setApiKey('sk_test_51MfMkoJ2N9DPH3m9vKvtiwUyxXbpsZo4NORmgqc6PDoFCNyFFHTrv2i1Gl5YnsEZ0hTXjuXrmOWfL4CIbks0TbEz00jCtZvQRC');


          // $token = $_POST['stripeToken'];

          // Stripe\charge::create();

          // $charge = Stripe\Charge::create([
          //   'amount' => 999*100,
          //   'currency' => 'usd',
          //   'description' => 'Online Shop',
          //   'source' => $token,
          //   'metadata' => ['order_id' => '6735'],
          // ]);

        if(Session::has('coupon')){

          $total_amount = Session::get('coupon')['total_amount'];

        }else{

          $total_amount = round(Cart::total());

        }



    
      \Stripe\Stripe::setApiKey('sk_test_51MfMkoJ2N9DPH3m9vKvtiwUyxXbpsZo4NORmgqc6PDoFCNyFFHTrv2i1Gl5YnsEZ0hTXjuXrmOWfL4CIbks0TbEz00jCtZvQRC');

      $token = $_POST['stripeToken'];

      $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Online Shop',
              'source' => $token,
            'metadata' => ['order_id' => uniqid()],
      ]);

      // dd($charge);

      $order_id= Order::insertGetId([

        'user_id' => Auth::id(),
        'division_id' => $request->division_id,
        'district_id' => $request->district_id,
        'state_id' => $request->state_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'adress' => $request->address,
        'post_code' => $request->post_code,
        'notes' => $request->notes,

        'payment_type' => $charge->payment_method,
        'payment_method' => 'Stripe',
        'transaction_id' => $charge->balance_transaction,
        'currency' => $charge->currency,
        'amount' => $total_amount,
        'order_number' => $charge->metadata->order_id,

        'invoice_no' => 'OS'.mt_rand(10000000,99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_year' => Carbon::now()->format('Y'), 
        'status' => 'pending',
        'created_at' => Carbon::now(),  



      ]);




      
      $carts = Cart::content();
      foreach($carts as $cart){

          OrderItem::insert([
              'order_id' => $order_id,
              'product_id' => $cart->id,
              'vendor_id' => $cart->options->vendor,
              'color' => $cart->options->color,
              'size' => $cart->options->size,
              'quantity' => $cart->qty,
              'price' => $cart->price,
              'created_at' =>Carbon::now(),

          ]);

      } // End Foreach

      if (Session::has('coupon')) {
        Session::forget('coupon');
      }

      Cart::destroy();

      $notification = array(
          'message' => 'Your Order Place Successfully',
          'alert-type' => 'success'
      );

  Notification::send($user, new OrderComplete($request->name));



      return redirect()->route('dashboard')->with($notification); 

  }//End Method


  public function CashOrder(Request $request){

    $user = User::where('role',"admin")->get();


    if(Session::has('coupon')){

      $total_amount = Session::get('coupon')['total_amount'];

    }else{

      $total_amount = round(Cart::total());

    }







   $order_id= Order::insertGetId([

    'user_id' => Auth::id(),
    'division_id' => $request->division_id,
    'district_id' => $request->district_id,
    'state_id' => $request->state_id,
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'adress' => $request->address,
    'post_code' => $request->post_code,
    'notes' => $request->notes,

    'payment_type' => "Cash On Delivery",
    'payment_method' => 'Cash On Delivery',
    'currency' => 'usd',
    'amount' => $total_amount,

    'invoice_no' => 'OS'.mt_rand(10000000,99999999),
    'order_date' => Carbon::now()->format('d F Y'),
    'order_month' => Carbon::now()->format('F'),
    'order_year' => Carbon::now()->format('Y'), 
    'status' => 'pending',
    'created_at' => Carbon::now(),  



  ]);


  
    //  //////// Start Send Mail ///////////////
    //  $invoice = Order::findOrFail($order_id);

    //  $data=[
    //    "invoice_no"=>$invoice->invoice_no,
    //    "amount"=>$total_amount,
    //    "name"=>$invoice->name,
    //    "email"=>$invoice->email

    //  ];

    //  // dd($data);

     
    //  // Mail::to('receiver-email-id')->send(new NotifyMail());
    //  Mail::to($request->email)->send(new OrderMail($data));

    //  if (Mail::failures()) {
    //       return response()->Fail('Sorry! Please try again latter');
    //  }else{
    //       return response()->success('Great! Successfully send in your mail');
    //     }

    //   //////// End Send Mail ///////////////



  
  $carts = Cart::content();
  foreach($carts as $cart){

      OrderItem::insert([
          'order_id' => $order_id,
          'product_id' => $cart->id,
          'vendor_id' => $cart->options->vendor,
          'color' => $cart->options->color,
          'size' => $cart->options->size,
          'quantity' => $cart->qty,
          'price' => $cart->price,
          'created_at' =>Carbon::now(),

      ]);

  } // End Foreach

  if (Session::has('coupon')) {
    Session::forget('coupon');
  }

  Cart::destroy();

  $notification = array(
      'message' => 'Your Order Place Successfully',
      'alert-type' => 'success'
  );

  Notification::send($user, new OrderComplete($request->name));


  return redirect()->route('dashboard')->with($notification); 


  }//End Method
}
