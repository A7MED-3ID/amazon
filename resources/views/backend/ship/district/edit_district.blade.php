@extends('admin.admin_dashboard')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    @include('success')


    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3"> Districts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit District</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row justify-content-center">

                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">
                                <form id="myForm" action={{route("district.update",$district->id)}} method="post">
                                    @csrf
                                    @method('put')



                                    <div class="row mb-3">
                                        <div class="col-sm-3 ">
                                            <h6 class="mb-0"> Division Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <select name="division_id" class="form-select mb-3"
                                                aria-label="Default select example">
                                              

                            @foreach ($divisions as $division)
                    <option value="{{ $division->id }}" {{$division->id==$district->division_id?"selected":""}}>{{ $division->name }}</option>
                                        @endforeach

                                            </select>
                                        </div>
                                    </div>



                                    <div class="row mb-3">
                                        <div class="col-sm-3 ">
                                            <h6 class="mb-0"> District Name</h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input name="name" type="text" class="form-control" value={{$district->name}} />
                                        </div>
                                    </div>















                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Change" />
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



    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    division_id:{
                        required: true,

                    }
                  
                },
                messages: {
                    brand_name: {
                        required: 'Please Enter District Name',
                    },
                    division_id: {
                        required: 'Please choose Division ',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>







   
@endsection
