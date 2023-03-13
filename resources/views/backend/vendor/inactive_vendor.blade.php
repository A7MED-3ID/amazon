
@extends('admin.admin_dashboard')


@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Inactive Vendors</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Inactive Vendors</li>
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
                      @foreach ($inactive_vendors as $key=>$inactive_vendor )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$inactive_vendor->name}}</td>
                            <td>{{$inactive_vendor->user_name}}</td>
                            <td>{{$inactive_vendor->email}}</td>

                            <td>{{$inactive_vendor->vendor_join}}</td>

                            <td>
                                <span class="btn btn-secondary">
                                    {{$inactive_vendor->status}}
                                </span>
                            </td>




                           




                            <td>


                                <a href={{route('inactive.vendor.details',$inactive_vendor->id)}} class="btn btn-outline-info " style="color:black">Vendor Details</a>

                               

                               
                                
                                
                             
                                

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