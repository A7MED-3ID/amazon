@extends('admin.admin_dashboard')


@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Banners</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Banners</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
          <a href={{route('banner.add')}} class="btn btn-primary">Add Banner</a>
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
                            <th>Banner Title</th>
                            <th>Banner URL</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($banners as $key=>$banner )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$banner->title}}</td>
                            <td>{{$banner->url}}</td>


                            <td><img src={{asset("storage/$banner->image")}} alt="banner_image" width="70px" height="40px"></td>
                            <td>
                                <a href={{route('banner.edit',$banner->id)}} class="btn btn-info">Edit</a>

                                <a href={{route('banner.delete',$banner->id)}}
                                    class="btn btn-danger" id="delete">Delete</a>

                               
                                
                                
                             
                                

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                        
                            <th>Sl</th>
                            <th>Banner Title</th>
                            <th>Banner URL</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        

                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>








@endsection