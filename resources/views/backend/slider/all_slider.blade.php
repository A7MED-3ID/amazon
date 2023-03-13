@extends('admin.admin_dashboard')


@section('content')




<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Sliders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Sliders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
          <a href={{route('slider.add')}} class="btn btn-primary">Add Slider</a>
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
                            <th>Slider Title</th>
                            <th>Slider Short Title</th>
                            <th>Slider Image</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($sliders as $key=>$slider )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$slider->title}}</td>
                            <td>{{$slider->short_title}}</td>


                            <td><img src={{asset("storage/$slider->image")}} alt="slider_image" width="70px" height="40px"></td>
                            <td>
                                <a href={{route('slider.edit',$slider->id)}} class="btn btn-info">Edit</a>

                                <a href={{route('slider.delete',$slider->id)}}
                                    class="btn btn-danger" id="delete">Delete</a>

                               
                                
                                
                             
                                

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Slider Title</th>
                            <th>Slider Short Title</th>
                            <th>Slider Image</th>
                            <th>Action</th>
                        

                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>








@endsection