@extends('admin.admin_dashboard')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@include('success')
  

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Inactive Vendor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Inactive Vendor Details</li>
                </ol>
            </nav>
        </div>
       
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
              
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                          <form action={{route('inactive.vendor.approve',$inactive_vendor->id)}} method="post" >
                            @csrf
                            @method('put')
                          
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"> User Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input  name="user_name"  type="text" class="form-control" value={{$inactive_vendor->user_name}} />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Shop Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="name" type="text" class="form-control" value={{$inactive_vendor->name}} />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="email" type="text" class="form-control" value={{$inactive_vendor->email}} />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="phone" type="text" class="form-control" value={{$inactive_vendor->phone}} />
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="address" type="text" class="form-control" value={{$inactive_vendor->address}} />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Join Date</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="vendor_join" type="text" class="form-control" value={{$inactive_vendor->vendor_join}} />
                                </div>
                            </div>


                         

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Info</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea name="vendor_short_info" class="form-control" placeholder="Vendor Info" rows="3">{{ $inactive_vendor->vendor_short_info }}
                                    </textarea>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Photo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img id="showImage" src="{{ (!empty($inactive_vendor->photo)) ? url("storage/$inactive_vendor->photo"):url('storage/vendor/no_image.jpg') }}" alt="vendor" style="width:100px; height: 100px;"  >
                                </div>
                            </div>


                            


                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-success px-4" value="Active" />
                                </div>
                            </div>
                         </form>
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>




   


@endsection