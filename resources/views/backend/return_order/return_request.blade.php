@extends('admin.admin_dashboard')


@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Return Orders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Return Orders</li>
                </ol>
            </nav>
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
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>State</th>

                            <th>Reason</th>



                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $key=>$order )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->order_date}}</td>
                            <td>{{$order->invoice_no}}</td>
                            <td>${{$order->amount}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>

                                @if ($order->return_order ==1)
                                <span class="badge rounded-pill bg-danger"> Pending </span>
                                    
                                @elseif($order->return_order ==2)

                                <span class="badge rounded-pill bg-success"> Success </span>
                                    
                                @endif
                              
                            </td>

                               <td>{{$order->return_reason}}</td>


                            <td>
                                <a href={{route('admin.order.details',$order->id)}} class="btn btn-info" title="Details"><i class="fa fa-eye"></i></a>


                                <a href="{{ route('return.request.approved',$order->id) }}" class="btn btn-danger" title="Approved" id="approved"><i class="fa-solid fa-person-circle-check"></i> </a>

                            </td>

                               
                                
                                
                             
                                

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                            
                            
                            <th>Sl</th>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>State</th>
                            <th>Reason</th>




                            <th>Action</th>
                        

                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>








@endsection