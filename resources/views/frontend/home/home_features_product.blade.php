@php
$fproducts =  App\Models\Product::where("featured",1)->orderBy("id","DESC")->get();
    
@endphp


<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>
             
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">


                                <!--Start product Wrap-->

                                @foreach ($fproducts as $fproduct)
                                    

                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href={{url("product/details/$fproduct->id/$fproduct->slug")}}>
                                                <img class="default-img" src={{asset("storage/$fproduct->product_thambnail")}} alt="" />
                                              
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"id={{$fproduct->id}} onclick="productView(this.id)"> <i class="fi-rs-eye"></i></a>
                                            <a id={{$fproduct->id}} onclick="addToWishList(this.id)" aria-label="Add To Wishlist" class="action-btn small hover-up" ><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn small hover-up"  id={{$fproduct->id}} onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        </div>
                                        @php
                                        $amount =$fproduct->selling_price-  $fproduct->discount_price;
                                        $discount = ($amount/$fproduct->selling_price) * 100;
                
                                     @endphp
                                        <div class="product-badges product-badges-position product-badges-mrg">
                  
                                @if($fproduct->discount_price == 0)
                                <span class="new">New</span>
                                @else
                                 <span class="hot">{{ round($discount) }}%</span>
                                @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{$fproduct['category']['name']}}</a>
                                        </div>
                                        <h2><a href={{url("product/details/$fproduct->id/$fproduct->slug")}}>{{$fproduct->name}}</a></h2>
                                        @php
                                        $avgRating = App\Models\Review::where("product_id",$fproduct->id)->where("status","!=",0)->avg('rating');
                            
                                        $reviews = App\Models\Review::where("product_id",$fproduct->id)->where("status","!=",0)->get();
                                        
                                    @endphp
                                            

                                            <div class="product-rate d-inline-block">

                                                @if($avgRating == 0)
                        
                                                @elseif($avgRating ==1 || $avgRating < 2 )
                                                    <div class="product-rating" style="width: 20%"></div>
                                                @elseif($avgRating ==2 || $avgRating < 3 )
                                                <div class="product-rating" style="width: 40%"></div>
                                                @elseif($avgRating ==3 || $avgRating < 4 )
                                                <div class="product-rating" style="width: 60%"></div>
                                                @elseif($avgRating ==4 || $avgRating < 5 )
                                                <div class="product-rating" style="width: 80%"></div>
                                                @elseif($avgRating ==5 || $avgRating < 5 )
                        
                                                <div class="product-rating" style="width: 100%"></div>
                        
                                                @endif
                                
                        
                        
                                                            </div>

                                      
                @if($fproduct->discount_price == 0)

                <div class="product-price">
                    <span>${{$fproduct->selling_price}}</span>
                </div>

                 

                @else
                <div class="product-price">
                    <span>${{$fproduct->discount_price}}</span>
                    <span class="old-price">${{$fproduct->selling_price}}</span>
                </div>
                @endif


                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                         
                                        </div>


                                        <div class="product-extra-link2">
                                            <input type="hidden" id="product_id">
                                            <button onclick="addToCart()" type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        </div>
                                       
                                    </div>
                                </div>

                                @endforeach

                                <!--End product Wrap-->


                             
                               
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->

                   
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>