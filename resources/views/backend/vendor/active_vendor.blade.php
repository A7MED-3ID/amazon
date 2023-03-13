
@extends('admin.admin_dashboard')


@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Active Vendors</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Active Vendors</li>
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
                            <th>Vendor Name </th>
                            <th>Vendor User Name </th>
                            <th>Vendor Email </th>
                            <th>Join Date </th>
                            <th>Status </th>

                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($active_vendors as $key=>$active_vendor )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$active_vendor->name}}</td>
                            <td>{{$active_vendor->user_name}}</td>
                            <td>{{$active_vendor->email}}</td>

                            <td>{{$active_vendor->vendor_join}}</td>

                            <td>
                                <span class="btn btn-success">
                                    {{$active_vendor->status}}
                                </span>
                            </td>




                           




                            <td>


                                <a href={{route('active.vendor.details',$active_vendor->id)}} class="btn btn-outline-info " style="color:black">Vendor Details</a>

                               

                               
                                
                                
                             
                                

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Vendor Name </th>
                            <th>Vendor User Name </th>
                            <th>Vendor Email </th>
                            <th>Join Date </th>
                            <th>Status </th>

                            <th>Action</th>
                        

                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>








@endsection