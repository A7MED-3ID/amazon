@extends('vendor.vendor_dashboard')

	
@php

$id= Auth::user()->id;
 $vendor= App\Models\User::find($id);
 $status = $vendor->status;
@endphp

@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Products  <span class="badge rounded-pill bg-danger"> {{ count($products) }} </span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
          <a href={{route('vendor.product.add')}} class="btn btn-primary">Add Product</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $key=>$product )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>

                            <td><img src={{asset("storage/$product->product_thambnail")}} alt="product_image" width="70px" height="40px"></td>


                            <td>{{$product->name}}</td>
                            <td>{{$product->selling_price}}</td>
                            <td>{{$product->quantity}}</td>
                            
                            <td>
                        @if($product->discount_price == 0)
                         <span class="badge rounded-pill bg-info">No Discount</span>
                        @else
                         @php
                            $amount =$product->selling_price- ($product->selling_price - $product->discount_price);
                            $discount = ($amount/$product->selling_price) * 100;

                         @endphp
                         <span class="badge rounded-pill bg-danger"> {{ round($discount) }}%</span>
                        @endif
                        </td>


                            <td>
                                @if($product->status == "active")
                                <span class="badge rounded-pill bg-success">Active</span>
                                @else
                                <span class="badge rounded-pill bg-danger">InActive</span>
                                @endif
                            </td>















                            <td>
                            
                                <a href={{route('vendor.product.edit',$product->id)}} class="btn btn-info" title="Edit Data">
                                    <i class="fa fa-pencil"></i>
                                  
                                </a>

                                <a href={{route('vendor.product.delete',$product->id)}} title="Delete Product"
                                    class="btn btn-danger" id="delete">
                                    <i class="fa fa-trash"></i>
                                </a> 

                              

                             
                                @if($product->status == "active")
                                <a href=
                                {{route('vendor.product.inactive',$product->id)}} class="btn btn-primary" title="Inactive"> <i class="fa-solid fa-thumbs-down"></i> </a>
                                @else
                                <a href={{route('vendor.product.active',$product->id)}} class="btn btn-primary" title="Active"> <i class="fa-solid fa-thumbs-up"></i> </a>
                                @endif
                                  

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>








@endsection