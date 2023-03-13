
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href={{asset('backend_admin/assets/images/favicon-32x32.png')}} type="image/png" />
	<!--plugins-->
	<link href={{asset('backend_admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}} rel="stylesheet"/>
	<link href={{asset('backend_admin/assets/plugins/simplebar/css/simplebar.css')}} rel="stylesheet" />
	<link href={{asset('backend_admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}} rel="stylesheet" />
	<link href={{asset('backend_admin/assets/plugins/metismenu/css/metisMenu.min.css')}} rel="stylesheet" />
	<!-- loader-->
	<link href={{asset('backend_admin/assets/css/pace.min.css')}} rel="stylesheet" />
	<script src={{asset('backend_admin/assets/js/pace.min.js')}}></script>
	<!-- Bootstrap CSS -->
	<link href={{asset('backend_admin/assets/css/bootstrap.min.css')}} rel="stylesheet">
	<link href={{asset('backend_admin/assets/css/app.css')}} rel="stylesheet">
	<link href={{asset('backend_admin/assets/css/icons.css')}} rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href={{asset('backend_admin/assets/css/dark-theme.css')}} />
	<link rel="stylesheet" href={{asset('backend_admin/assets/css/semi-dark.css')}} />
	<link rel="stylesheet" href={{asset('backend_admin/assets/css/header-colors.css')}} />

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

     {{-- Font Awesome --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />



	    {{-- input tags --}}
		<link href={{asset("backend_admin/assets/plugins/input-tags/css/tagsinput.css")}} rel="stylesheet" />

		{{-- Data table --}}

	<link href={{asset("backend_admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}} rel="stylesheet" />


	{{-- toaster --}}

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

	<title>Vendor Dashboard</title>
</head>

<body>
	@php

    $id= Auth::user()->id;
     $vendor= App\Models\User::find($id);
     $status = $vendor->status;
@endphp

	@if ($status === "active")

	<h4>Vendor Account Is <span class="text-success"> Active</span></h4>
	@else
	<h4>Vendor Account Is <span class="text-danger"> InActive</span></h4>
	<p class="text-danger "> <b>Please Wait Admin Will Check And Approve Your Account</b></p>
	
	 
	@endif 






	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('vendor.body.sidebar')
		<!--end sidebar wrapper -->


		<!--start header -->
		@include('vendor.body.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			@yield('content')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		@include('vendor.body.footer')
	</div>
	<!--end wrapper-->
	<!--start switcher-->
	@include('admin.body.switcher')
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src={{asset("backend_admin/assets/js/bootstrap.bundle.min.js")}}></script>
	<!--plugins-->
	<script src={{asset("backend_admin/assets/js/jquery.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/simplebar/js/simplebar.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/metismenu/js/metisMenu.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/chartjs/js/Chart.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js")}}></script>
    <script src={{asset("backend_admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/sparkline-charts/jquery.sparkline.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/jquery-knob/excanvas.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/jquery-knob/jquery.knob.js")}}></script>
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
	  <script src={{asset("backend_admin/assets/js/index.js")}}></script>
	<!--app JS-->
	<script src={{asset("backend_admin/assets/js/app.js")}}></script>

	
	{{-- data table --}}

	<script src={{asset("backend_admin/assets/plugins/datatable/js/jquery.dataTables.min.js")}}></script>
	<script src={{asset("backend_admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js")}}></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
     {{-- validate file --}}
	<script src={{asset('backend_admin/assets/js/validate.min.js')}}></script>



	{{-- data table --}}
















	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
	 @if(Session::has('message'))
	 var type = "{{ Session::get('alert-type','info') }}"
	 switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;
	
		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;
	
		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;
	
		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break; 
	 }
	 @endif 
	</script>


{{-- sweat alert --}}


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <script src="{{ asset('backend_admin/assets/js/code.js') }}"></script>


{{-- //  input tags  --}}

<script src={{asset('backend_admin/assets/plugins/input-tags/js/tagsinput.js')}}></script>






{{-- text area --}}

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
	tinymce.init({
	  selector: '#mytextarea'
	});
</script>




</body>

</html>