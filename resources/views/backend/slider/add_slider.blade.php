@extends('admin.admin_dashboard')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


@include('success')
  

<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Sliders</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Slider</li>
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
                          <form id="myForm" action={{route('slider.add.store')}} method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="row mb-3">
                                <div class="col-sm-3 ">
                                    <h6 class="mb-0"> Slider Title</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input  name="title"  type="text" class="form-control" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3 ">
                                    <h6 class="mb-0"> Slider Short Title</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input  name="short_title"  type="text" class="form-control" />
                                </div>
                            </div>


                         
                         
                         
                       
                        


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Slider Image</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input name="image" type="file" class="form-control" id="image" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0"> </h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                     <img id="showImage" src="{{url('storage/slider/no_image.jpg') }}" alt="image" style="width:100px; height: 100px;"  >
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Add" />
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
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                title: {
                    required : true,
                }, 
                short_title: {
                    required : true,
                }, 
                image: {
                    required : true,
                },
            },
            messages :{
                title: {
                    required : 'Please Enter Slider Title',
                },
               short_title: {
                    required : 'Please Enter Slider Short Title',
                },
                image: {
                    required : 'Please Enter Slider Image',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>







<script type="text/javascript">
	$(document).ready(function(){
		$('#image').change(function(e){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#showImage').attr('src',e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});


</script>
   


@endsection