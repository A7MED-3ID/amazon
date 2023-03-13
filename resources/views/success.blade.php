@if (session()->has("success"))
 <div class="alert alert-success" role="alert">

 
     {{session()->get("success")}}
 </div>



 
  <br>

@elseif(session()->has("update"))

<div class="alert alert-success" role="alert">
  {{session()->get("update")}}
</div>
<br>

@elseif(session()->has("delete"))

<div class="alert alert-danger" role="alert">
  {{session()->get("delete")}}
</div>

    <br>




@elseif(session()->has("error"))

<div class="alert alert-danger" role="alert">
  {{session()->get("error")}}
</div>

  <br>

@endif
