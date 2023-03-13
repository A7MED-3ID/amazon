@extends('admin.admin_dashboard')


@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Brands</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Brands</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
          <a href={{route('add.brand')}} class="btn btn-primary">Add Brand</a>
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
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($brands as $key=>$brand )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$brand->name}}</td>

                            <td><img src={{asset("storage/$brand->image")}} alt="brand_image" width="70px" height="40px"></td>
                            <td>
                                <a href={{route('brand.edit',$brand->id)}} class="btn btn-info">Edit</a>

                                <a href={{route('brand.delete',$brand->id)}}
                                    class="btn btn-danger" id="delete">Delete</a>

                               
                                
                                
                             
                                

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Action</th>
                        

                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>





{{-- {{ $brands->links() }} --}}


@endsection