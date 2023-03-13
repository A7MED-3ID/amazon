@extends('admin.admin_dashboard')


@section('content')



<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All Districts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Districts</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
          <a href={{route('district.add')}} class="btn btn-primary">Add District</a>
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


                            <th>Division Name</th>
                            <th>District Name</th>

                            

                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($districts as $key=>$district )
                          
                      
                        <tr>
                            <td>{{$key+1}}</td>

                            <td>{{$district['division']['name']}}</td>
                            <td>{{$district->name}}</td>

                            

                            

                            



        

                            <td>


                                <a href={{route('district.edit',$district->id)}} class="btn btn-info">Edit</a>

                                <a href={{route('district.delete',$district->id)}}
                                    class="btn btn-danger" id="delete">Delete</a>

                               
                                
                                
                             
                                

                            </td>
                            
                        </tr>
                        @endforeach
                      
                    </tbody>
                
                    <tfoot>
                        <tr>
                            <th>Sl</th>


                            <th>Division Name</th>

                            <th>District Name</th>

                            

                            <th>Action</th>
                            
                        

                            
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
 
</div>





@endsection