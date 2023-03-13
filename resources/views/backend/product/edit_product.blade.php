@extends('admin.admin_dashboard')


@section('content')

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
       
    </div>
    <!--end breadcrumb-->

    

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Edit Product</h5>
          <hr/>

          <form id="myForm" method="post" 
          action={{route('update.product',$product->id)}} >
            @csrf
            @method('put')
           <div class="form-body mt-4">
            <div class="row">
               <div class="col-lg-8">
               <div class="border border-3 p-4 rounded">
                 <div class="form-group mb-3">
                    <label for="inputProductTitle" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" id="inputProductTitle" value={{$product->name}}>
                  </div>



                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                    <input name="tags" type="text" class="form-control visually-hidden" data-role="tagsinput" value={{$product->tags}}>
                  </div>



                  
                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Size</label>
                    <input name="size" type="text" class="form-control visually-hidden" data-role="tagsinput" value={{$product->size}}>
                  </div>


                  
                  <div class="mb-3">
                    <label for="inputProductTitle" class="form-label">Product Colors</label>
                    <input name="color" type="text" class="form-control visually-hidden" data-role="tagsinput" value={{$product->color}}>
                  </div>



                  <div class="form-group mb-3">
                    <label for="inputProductDescription" class="form-label">Short Description</label>
                    <textarea name="short_desc" class="form-control" id="inputProductDescription" rows="3">{{$product->short_desc}}</textarea>
                  </div>



                  <div class="mb-3">
                    <label for="inputProductDescription" class="form-label">Long Description</label>
                  	<textarea  name="long_desc" id="mytextarea" name="mytextarea">{!!$product->long_desc!!}</textarea>
                  </div>




              




                    
                 
              




                
                </div>
               </div>
               <div class="col-lg-4">
                <div class="border border-3 p-4 rounded">
                  <div class="row g-3">
                    <div class="form-group col-md-6">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="text" name="selling_price" class="form-control" id="inputPrice" value={{$product->selling_price}}>
                      </div>

                      <div class=" col-md-6">
                        <label for="inputCompareatprice" class="form-label">Discount Price</label>
                        <input name="discount_price" type="text" class="form-control" id="inputCompareatprice" value={{$product->discount_price}}>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputCostPerPrice" class="form-label">Product Code</label>
                        <input type="text" class="form-control" id="inputCostPerPrice" name="code" value={{$product->code}}>
                      </div>

                      <div class="form-group col-md-6">
                        <label for="inputStarPoints" class="form-label"> Product Quantity</label>
                        <input name="quantity" type="text" class="form-control" id="inputStarPoints" value={{$product->quantity}}>
                      </div>


                      <div class="col-12">
                        <label for="inputProductType" class="form-label">Product Brand</label>
                        <select name="brand_id" class="form-select" id="inputProductType">
                          
                            @foreach ($brands as $brand)
                            <option value={{$brand->id}} 
                              {{$brand->id==$product->brand_id? "selected": ""}}>{{$brand->name}}</option>
                              
                            @endforeach
                            
                          </select>
                      </div>


                      <div class="col-12">
                        <label for="category" class="form-label">Product Category</label>
                        <select name="category_id" class="form-select" id="category">
                      
                            @foreach ($categories as $category)
                            <option value={{$category->id}}
                              {{$category->id==$product->category_id? "selected": ""}}>{{$category->name}}</option>
                              
                            @endforeach
                           
                          </select>
                      </div>


                      <div class="col-12">
                        <label for="inputCollection" class="form-label">Product SubCategory</label>
                        <select name="subcategory_id" class="form-select" id="inputCollection">
                         
                            @foreach ($subcategories as $subcategory)
                            <option value={{$subcategory->id}}
                              {{$subcategory->id==$product->subcategory_id? "selected": ""}}>{{$subcategory->name}}</option>
                              
                            @endforeach
                           
                          </select>
                      </div>



                      <div class="col-12">
                        <label for="inputCollection" class="form-label">Select Vendor</label>
                        <select name="vendor_id" class="form-select" id="inputCollection">
                          @foreach ($vendors as $vendor)
                          <option value={{$vendor->id}}
                            {{$vendor->id==$product->vendor_id? "selected": ""}}>{{$vendor->name}}</option>
                            
                          @endforeach
                          
                          </select>
                      </div>


                      <div class="col-12">
                       <div class="row g-3">
                        <div class="col-md-6">
                          <div class="form-check">
                            <input name="hot_deals" id="hot_deals" class="form-check-input" type="checkbox" 
                            {{$product->hot_deals==1?"checked":""}}>
                            <label for="hot_deals" class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                          </div>

                        </div>


                        <div class="col-md-6">
                          <div class="form-check">
                            <input name="featured" class="form-check-input" type="checkbox" id="featured"
                            {{$product->featured==1?"checked":""}}>
                            <label class="form-check-label" for="featured">featured</label>
                          </div>

                        </div>


                        <div class="col-md-6">
                          <div class="form-check">
                            <input name="special_offer" class="form-check-input" type="checkbox"  id="special_offer"
                            {{$product->special_offer==1?"checked":""}}>
                            <label class="form-check-label" for="special_offer">Special Offer</label>
                          </div>

                        </div>



                        <div class="col-md-6">
                          <div class="form-check">
                            <input name="special_deals" class="form-check-input" type="checkbox" id="special_deals"
                            {{$product->special_deals==1?"checked":""}}>
                            <label class="form-check-label" for="special_deals">Special Deals</label>
                          </div>

                        </div>




                       </div>


                      </div>



                      <hr>
                      <div class="col-12">
                          <div class="d-grid">
                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                          </div>
                      </div>
                  </div> 
              </div>
              </div>
           </div><!--end row-->
        </div>

          </form>


      
      
      
      
      </div>
  </div>

</div>





 {{-- main thambanil --}}
<div class="page-content">
  <h6>Update Main Thambnail </h6>
  <hr>
  <div class="card">
   
    <form action={{route('update.product.thambnail',$product->id)}} method="post" enctype="multipart/form-data">
      @csrf
      @method('put')
      
      <div class="card-body">
        <div class="form-group mb-3">
          <label for="main">Choose Image</label>
        
          <input name="product_thambnail" type="file" class="form-control" id="image" />
    
      
        </div>
        <div class="mb-3">
        

           <img id="showImage" src={{url("storage/$product->product_thambnail")}} alt="image" style="width:100px; height: 100px;"  >
        </div>
      </div>



      
          <input type="submit" class="btn btn-primary px-4 m-3" value="Save Changes" />
     
    </form>

  </div>
</div>

{{-- End thambanil --}}


{{-- Multi images Update  --}}

<div class="page-content">
  <h6>Update Multi Images</h6>
  <hr>
  
<div class="card">
  <div class="card-body">
    <table class="table mb-0 table-striped">
      <thead>
        <tr>
          <th scope="col">#SI</th>
          <th scope="col">Image</th>
          <th scope="col">Change Image</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <form method="post" action="{{ route('update.product.multiImg',$product->id) }}" enctype="multipart/form-data" >
          @csrf
          @method('put')
    
      @foreach($multi_imgs as $key => $img)
      <tr>
        <th scope="row">{{ $key+1 }}</th>
        <td> <img src="{{ asset("storage/$img->photo_name") }}" width="70px" height="40px"> </td>
        <td> <input type="file" class="form-group" name="multi_img[{{ $img->id }}]"> </td>
        <td> 
      <input type="submit" class="btn btn-primary px-4" value="Update Image " />		
      <a href={{ route('product.multiimg.delete',$img->id) }} class="btn btn-danger" id="delete" > Delete </a>		
        </td>
      </tr>
      @endforeach		 
    
    </form>	


    {{-- {{ route('product.multiimg.delete',$img->id) }} --}}
          
       
      
      
      
      </tbody>
    </table>
  </div>
</div>
</div>





{{-- end Multi Image Update  --}}














<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




<script> 
 
  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   
  </script>





<script type="text/javascript">
  		
  $(document).ready(function(){
    $('select[name="category_id"]').on('change', function(){
      var category_id = $(this).val();
      if (category_id) {
        $.ajax({
          url: "{{ url('/subcategory/ajax') }}/"+category_id,
          type: "GET",
          dataType:"json",
          success:function(data){
            $('select[name="subcategory_id"]').html('');
            var d =$('select[name="subcategory_id"]').empty();
            $.each(data, function(key, value){
              $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.name + '</option>');
            });
          },

        });
      } else {
        alert('danger');
      }
    });
  });

</script>






<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              name: {
                  required : true,
              }, 
              short_desc: {
                  required : true,
              }, 
               product_thambnail: {
                  required : true,
              }, 
               multi_img: {
                  required : true,
              }, 
               selling_price: {
                  required : true,
              },                   
               code: {
                  required : true,
              }, 
               quantity: {
                  required : true,
              }, 
               brand_id: {
                  required : true,
              }, 
               category_id: {
                  required : true,
              }, 
               subcategory_id: {
                  required : true,
              }, 
          },
          messages :{
              name: {
                  required : 'Please Enter Product Name',
              },
              short_desc: {
                  required : 'Please Enter Short Description',
              },
              product_thambnail: {
                  required : 'Please Select Product Thambnail Image',
              },
              multi_img: {
                  required : 'Please Select Product Multi Image',
              },
              selling_price: {
                  required : 'Please Enter Selling Price',
              }, 
              code: {
                  required : 'Please Enter Product Code',
              },
               quantity: {
                  required : 'Please Enter Product Quantity',
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